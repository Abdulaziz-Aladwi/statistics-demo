<?php

namespace App\Jobs\Admin\Statistics;

use App\Models\User;
use App\Services\Statistics\StatisticsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncrementUserTasksCount implements ShouldQueue
{
    use Queueable;

    /** @var User */
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StatisticsService $statisticsService)
    {
        $statisticsService->incrementUserTasksCount($this->user);
    }
}
