<?php

namespace App\Providers;

use App\Models\DesignPriority;
use App\Models\DesignRequest;
use App\Models\DesignState;
use App\Models\DesignTask;
use App\Models\DesignTimeState;
use App\Models\Report;
use App\Observers\DesignPriorityObserver;
use App\Observers\DesignRequestObserver;
use App\Observers\DesignStateObserver;
use App\Observers\DesignTaskObserver;
use App\Observers\DesignTimeStateObserver;
use App\Observers\ReportObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        DesignPriority::observe(DesignPriorityObserver::class);
        DesignRequest::observe(DesignRequestObserver::class);
        DesignState::observe(DesignStateObserver::class);
        DesignTask::observe(DesignTaskObserver::class);
        DesignTimeState::observe(DesignTimeStateObserver::class);
        Report::observe(ReportObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
