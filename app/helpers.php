<?php

use Carbon\Carbon;

function formatDate(string $dateString)
{
    $date = Carbon::createFromFormat('Ymd', $dateString);

    return $date->format('Y/m/d');
}

function formatTime(string $timeString)
{
    $time = Carbon::createFromFormat('His', $timeString);

    return $time->format('H:i:s');
}

function removeSpace(string $string)
{
    if ($string != '') {
        return str_replace(' ', '', $string);
    }

    return null;
}
