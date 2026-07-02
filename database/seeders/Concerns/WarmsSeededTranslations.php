<?php

namespace Database\Seeders\Concerns;

use App\Jobs\WarmTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * Shared seeder hook: after a record is inserted, queue its translation
 * warming. Dispatching the job (rather than translating inline) keeps seeding
 * non-blocking — with QUEUE_CONNECTION=database the work is picked up by
 * `queue:work`; with the `sync` driver it runs immediately.
 *
 * Controlled by config('translation.seed_warm') so seeding can run untouched
 * in offline/CI environments.
 */
trait WarmsSeededTranslations
{
    /**
     * Queue translation warming for one or many freshly-seeded records.
     *
     * @param  Model|iterable<Model>  $records
     */
    protected function warmSeededTranslations(Model|iterable $records): void
    {
        if (! config('translation.seed_warm', true)) {
            return;
        }

        $records = $records instanceof Model ? [$records] : $records;

        foreach ($records as $record) {
            WarmTranslations::dispatch($record);
        }
    }
}
