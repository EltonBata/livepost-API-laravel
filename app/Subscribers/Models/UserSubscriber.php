<?php

namespace App\Subscribers\Models;

use App\Events\Models\user\CreatedUserEvent;
use App\Events\Models\user\DeletedUserEvent;
use App\Events\Models\user\UpdatedUserEvent;
use App\Listeners\Models\user\SendDeletedNotification;
use App\Listeners\Models\user\SendUpdatedNotification;
use App\Listeners\Models\user\SendWelcomeEmail;
use Illuminate\Events\Dispatcher;

class UserSubscriber
{

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UpdatedUserEvent::class, SendUpdatedNotification::class);
        $events->listen(DeletedUserEvent::class, SendDeletedNotification::class);
        $events->listen(CreatedUserEvent::class, SendWelcomeEmail::class);
    }
}