<?php

namespace App\Jobs\Onboarding;

use App\Pipelines\Onboarding\OnboardingPipeline;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OnboardingJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $data
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new OnboardingPipeline())->handle($this->data);
    }
}
