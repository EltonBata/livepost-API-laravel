<?php

namespace App\Providers;

use App\Subscribers\Models\CommentSubscriber;
use App\Subscribers\Models\PostSubscriber;
use App\Subscribers\Models\UserSubscriber;
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

        // CreatedUserEvent::class => [
        //     SendWelcomeEmail::class,
        // ],

        // UpdatedUserEvent::class => [
        //     SendUpdatedNotification::class
        // ],

        // DeletedUserEvent::class => [
        //     SendDeletedNotification::class
        // ]
    ];

    protected $subscribe = [
        UserSubscriber::class,
        PostSubscriber::class,
        CommentSubscriber::class
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}