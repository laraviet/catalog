<?php

function getAuthUsername()
{
    if (!Auth::check()) {
        return "";
    }

    return Auth::user()->name;
}

/**
 * @return string
 */
function getAuthRole($user)
{
    $authUserId = $user->id;

    return \App\UserRole::where('user_id', $authUserId)->first()->role_id;
}

