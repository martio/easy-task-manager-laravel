<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Commands\User\ImportUserCommand;
use App\Commands\User\ImportUserHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportUserJob implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $externalId,
    ) {
    }

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        return $this->externalId;
    }

    /**
     * Execute the job.
     */
    public function handle(ImportUserHandler $handler): void
    {
        ($handler)(new ImportUserCommand(
            externalId: $this->externalId,
        ));
    }
}
