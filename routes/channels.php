<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{userA}.{userB}', function ($user, $userA, $userB) {
    return $user->id == $userA || $user->id == $userB;
});
