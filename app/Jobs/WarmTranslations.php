<?php

namespace App\Jobs;

use App\Services\TranslationWarmer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Background job that warms the translation cache for one record.
 *
 * Dispatched by the seeders so seeding never blocks on translation-API calls
 * (with QUEUE_CONNECTION=database the work runs in `queue:work`; with the
 * `sync` driver it runs inline). Idempotent: safe to dispatch repeatedly.
 */
class WarmTranslations implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var class-string<Model> */
    public string $modelClass;
    public int|string $modelId;

    public int $tries = 3;
    public int $backoff = 30;

    public function __construct(Model $model)
    {
        $this->modelClass = $model::class;
        $this->modelId    = $model->getKey();
    }

    /** Prevent piling up duplicate jobs for the same record while one is pending. */
    public function uniqueId(): string
    {
        return $this->modelClass . ':' . $this->modelId;
    }

    public function handle(): void
    {
        /** @var Model|null $model */
        $model = $this->modelClass::find($this->modelId);

        if ($model) {
            TranslationWarmer::warm($model);
        }
    }
}
