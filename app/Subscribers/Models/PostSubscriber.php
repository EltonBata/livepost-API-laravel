<?php

namespace App\Subscribers\Models;

use App\Events\Models\post\CreatedPostEvent;
use App\Events\Models\post\DeletedPostEvent;
use App\Events\Models\post\UpdatedPostEvent;
use App\Listeners\Models\post\SendCreatedNotification;
use App\Listeners\Models\post\SendDeletedNotification;
use App\Listeners\Models\post\SendUpdatedNotification;
use Illuminate\Events\Dispatcher;


class PostSubscriber
{

    public function subscribe(Dispatcher $events)
    {
        $events->listen(CreatedPostEvent::class, SendCreatedNotification::class);
        $events->listen(UpdatedPostEvent::class, SendUpdatedNotification::class);
        $events->listen(DeletedPostEvent::class, SendDeletedNotification::class);
    }
}