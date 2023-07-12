<?php

function timeConversion($timeValue) {
    $time = substr($timeValue, 0, 8);
    $merdiem = substr($timeValue, 8);
    $hours = intval(substr($time, 0, 2));

    if ($time === '12:00:00' && $merdiem === 'AM') {
        return '00:00:00';
    }

    if ($time === '12:00:00' && $merdiem === 'PM') {
        return '12:00:00';
    }

    if ($merdiem === 'AM') {

        $hours = ($hours === 12) ? '00' : $hours;

        $time = $hours . substr($time, 2);
    }

    if ($merdiem === 'PM') {
        $hours = ($hours !== 12) ? $hours += 12 : $hours;

        $time = $hours . substr($time, 2);
    }

    return $time;
}

$inputTime = '12:01:00AM';
echo timeConversion($inputTime);