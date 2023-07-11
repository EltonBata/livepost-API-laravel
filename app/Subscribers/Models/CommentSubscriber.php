<?php

namespace App\Subscribers\Models;

use App\Events\Models\comment\CreatedCommentEvent;
use App\Events\Models\comment\DeletedCommentEvent;
use App\Events\Models\comment\UpdatedCommentEvent;
use App\Listeners\Models\comment\SendCreatedNotification;
use App\Listeners\Models\comment\SendDeletedNotification;
use App\Listeners\Models\comment\SendUpdatedNotification;
use Illuminate\Events\Dispatcher;

class CommentSubscriber
{

    public function subscribe(Dispatcher $events)
    {
        $events->listen(CreatedCommentEvent::class, SendCreatedNotification::class);
        $events->listen(UpdatedCommentEvent::class, SendUpdatedNotification::class);
        $events->listen(DeletedCommentEvent::class, SendDeletedNotification::class);
    }
}