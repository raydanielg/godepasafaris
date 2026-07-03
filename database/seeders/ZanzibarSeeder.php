<?php

namespace Database\Seeders;

use App\Models\ZanzibarActivity;
use Illuminate\Database\Seeder;

/**
 * Seeds the editable Zanzibar content from config/zanzibar.php so the admin
 * panel starts populated. Idempotent — keyed on category + title.
 */
class ZanzibarSeeder extends Seeder
{
    public function run(): void
    {
        $cfg = config('zanzibar', []);
        $order = 0;

        $add = function (string $category, array $data) use (&$order) {
            $order++;
            ZanzibarActivity::firstOrCreate(
                ['category' => $category, 'title' => $data['title']],
                array_merge(['display_order' => $order, 'is_active' => true], $data),
            );
        };

        foreach ($cfg['beaches'] ?? [] as $b) {
            $add('beaches', [
                'title' => $b['name'], 'description' => $b['desc'] ?? null, 'icon' => $b['icon'] ?? null,
                'best_time' => $b['best_time'] ?? null, 'details' => implode("\n", $b['activities'] ?? []),
            ]);
        }
        foreach ($cfg['stone_town'] ?? [] as $s) {
            $add('stone_town', ['title' => $s['name'], 'description' => $s['desc'] ?? null, 'icon' => $s['icon'] ?? null]);
        }
        foreach ($cfg['culture'] ?? [] as $c) {
            $add('culture', ['title' => $c['name'], 'icon' => $c['icon'] ?? null]);
        }
        foreach ($cfg['spices'] ?? [] as $s) {
            $add('spices', ['title' => $s['name'], 'description' => $s['desc'] ?? null, 'icon' => $s['icon'] ?? null]);
        }
        foreach ($cfg['turtle'] ?? [] as $t) {
            $add('turtle', ['title' => $t['name'], 'description' => $t['desc'] ?? null, 'icon' => $t['icon'] ?? null]);
        }
        foreach ($cfg['marine'] ?? [] as $m) {
            $add('marine', ['title' => $m['name'], 'icon' => $m['icon'] ?? null]);
        }
        foreach (($cfg['prison_island']['features'] ?? []) as $p) {
            $add('prison_island', ['title' => $p['name'], 'description' => $p['desc'] ?? null, 'icon' => $p['icon'] ?? null]);
        }
        foreach (($cfg['jozani']['features'] ?? []) as $j) {
            $add('jozani', ['title' => $j['name'], 'description' => $j['desc'] ?? null, 'icon' => $j['icon'] ?? null]);
        }
        foreach ($cfg['packages'] ?? [] as $p) {
            $add('packages', [
                'title' => $p['name'], 'description' => $p['tag'] ?? null, 'icon' => $p['icon'] ?? null,
                'price' => $p['from'] ?? null, 'duration' => isset($p['nights']) ? ($p['nights'] + 1) . ' Days / ' . $p['nights'] . ' Nights' : null,
                'details' => implode("\n", $p['includes'] ?? []),
            ]);
        }
    }
}
