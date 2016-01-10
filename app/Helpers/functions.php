<?php

function getAuthUsername()
{
    if (!Auth::check()) {
        return "";
    }

    return Auth::user()->name;
}

