<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\BookingActivityLog;
use Illuminate\Console\Command;

/**
 * Finds and (optionally) removes spam/bot bookings without ever running a
 * bare DELETE against production data. Always backs up first, and requires
 * two explicit steps before anything is permanently removed:
 *
 *   php artisan bookings:clean                 # dry run, safe, no changes
 *   php artisan bookings:clean --mark-spam      # backs up, then flags matches as status=spam
 *                                                 (reversible — review/un-flag in the admin panel)
 *   php artisan bookings:clean --purge          # backs up, then permanently deletes rows
 *                                                 already marked status=spam
 */
class CleanBookings extends Command
{
    protected $signature = 'bookings:clean
        {--mark-spam : Flag suspicious bookings as status=spam instead of just listing them}
        {--purge : Permanently delete bookings already marked status=spam (run --mark-spam first)}';

    protected $description = 'Find suspicious/spam bookings, optionally flag them as spam, optionally purge already-flagged spam';

    public function handle(): int
    {
        if ($this->option('purge')) {
            return $this->purgeSpam();
        }

        $flagged = $this->findSuspicious();

        if ($flagged->isEmpty()) {
            $this->info('No suspicious bookings found.');
            return self::SUCCESS;
        }

        $this->table(
            ['ID', 'Name', 'Email', 'Phone', 'Travel Date', 'Reason'],
            $flagged->map(fn ($row) => [
                $row['booking']->id,
                $row['booking']->name,
                $row['booking']->email,
                $row['booking']->phone,
                optional($row['booking']->travel_date)->format('Y-m-d'),
                $row['reason'],
            ])
        );

        $this->line($flagged->count().' suspicious booking(s) found.');

        if (!$this->option('mark-spam')) {
            $this->comment('Dry run only — nothing was changed. Re-run with --mark-spam to flag these as spam.');
            return self::SUCCESS;
        }

        $this->backup();

        foreach ($flagged as $row) {
            $booking = $row['booking'];
            $booking->update(['status' => 'spam']);

            BookingActivityLog::create([
                'booking_id' => $booking->id,
                'user_id' => null,
                'action' => 'marked_spam',
                'description' => 'bookings:clean — '.$row['reason'],
            ]);
        }

        $this->info($flagged->count().' booking(s) flagged as spam. Review them under Admin > Bookings, then run --purge to delete permanently.');

        return self::SUCCESS;
    }

    private function purgeSpam(): int
    {
        $spam = Booking::where('status', 'spam')->get();

        if ($spam->isEmpty()) {
            $this->info('No bookings are currently marked as spam. Run --mark-spam first.');
            return self::SUCCESS;
        }

        $this->table(['ID', 'Name', 'Email'], $spam->map(fn ($b) => [$b->id, $b->name, $b->email]));

        if (!$this->confirm("Permanently delete these {$spam->count()} spam booking(s)? This cannot be undone.")) {
            $this->comment('Cancelled — nothing was deleted.');
            return self::SUCCESS;
        }

        $this->backup();

        foreach ($spam as $booking) {
            BookingActivityLog::create([
                'booking_id' => $booking->id,
                'user_id' => null,
                'action' => 'purged',
                'description' => "Permanently deleted via bookings:clean --purge ({$booking->email})",
            ]);
        }

        Booking::where('status', 'spam')->delete();

        $this->info($spam->count().' spam booking(s) permanently deleted.');

        return self::SUCCESS;
    }

    /**
     * @return \Illuminate\Support\Collection<int, array{booking: Booking, reason: string}>
     */
    private function findSuspicious()
    {
        return Booking::where('status', '!=', 'spam')
            ->get()
            ->map(fn (Booking $booking) => [
                'booking' => $booking,
                'reason' => $this->suspicionReason($booking),
            ])
            ->filter(fn ($row) => $row['reason'] !== null)
            ->values();
    }

    private function suspicionReason(Booking $booking): ?string
    {
        if ($booking->travel_date && $booking->travel_date->isPast()) {
            return 'travel date is in the past ('.$booking->travel_date->format('Y-m-d').')';
        }

        if ($booking->email && !filter_var($booking->email, FILTER_VALIDATE_EMAIL)) {
            return 'invalid email format';
        }

        if ($booking->phone) {
            $digits = preg_replace('/\D/', '', $booking->phone);
            if (strlen($digits) < 7 || strlen($digits) > 15) {
                return 'phone number has an implausible length';
            }
        }

        if ($booking->name && (strlen(trim($booking->name)) < 2 || ctype_digit(trim($booking->name)))) {
            return 'name looks fake';
        }

        return null;
    }

    /**
     * Dumps the bookings table before any mutation. MySQL uses mysqldump;
     * SQLite (local/dev) just copies the database file — either way, a
     * timestamped backup lands in storage/app/backups before we touch data.
     */
    private function backup(): void
    {
        $connection = config('database.default');
        $dir = storage_path('app/backups');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $timestamp = now()->format('Y_m_d_His');

        if ($connection === 'sqlite') {
            $source = config('database.connections.sqlite.database');
            $dest = "{$dir}/bookings_backup_{$timestamp}.sqlite";
            copy($source, $dest);
            $this->comment("Backup written to {$dest}");
            return;
        }

        $config = config("database.connections.{$connection}");
        $dest = "{$dir}/bookings_backup_{$timestamp}.sql";

        $command = sprintf(
            'mysqldump -h%s -P%s -u%s %s %s bookings > %s',
            escapeshellarg($config['host']),
            escapeshellarg((string) $config['port']),
            escapeshellarg($config['username']),
            $config['password'] !== '' ? '-p'.escapeshellarg($config['password']) : '',
            escapeshellarg($config['database']),
            escapeshellarg($dest)
        );

        exec($command, $output, $exitCode);

        if ($exitCode !== 0 || !file_exists($dest) || filesize($dest) === 0) {
            $this->error('mysqldump backup failed — aborting before any data is changed. Check that the `mysqldump` binary is on the server PATH.');
            throw new \RuntimeException('Booking backup failed; refusing to proceed without a backup.');
        }

        $this->comment("Backup written to {$dest}");
    }
}
