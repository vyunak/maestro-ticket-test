<?php

function toMatch($input)
{
    preg_match('/^(([0-1][0-9]|[2][0-3]):([0-5][0-9]))-(([0-1][0-9]|[2][0-3]):([0-5][0-9]))$/', $input, $matches);
    return $matches;
}

function toSecond($time)
{
    return strtotime($time) - strtotime('TODAY');
}

function validate($input)
{
    $matches = toMatch($input);
    if (!empty($matches) && toSecond($matches[4]) >= toSecond($matches[1])) {
        return true;
    }
    return false;
}

function checkOverlay($time)
{
    global $timeList;

    if (!isset($timeList)) {
        $timeList = [];
    }

    if (validate($time) === false) {
        return false;
    }

    $match = toMatch($time);
    $startTime = toSecond($match[1]);
    $endTime = toSecond($match[4]);

    foreach ($timeList as $start => $end)
    {
        if (!($end <= $startTime || $start >= $endTime)) {
            return false;
        }
    }
    $timeList[$startTime] = $endTime;
    return true;
}

// использовал вводные данные из примера
$list = array (
    '10:00-14:00',
    '16:00-20:00',
    '09:00-11:00',
    '11:00-13:00',
    '14:00-16:00',
    '14:00-16:00',
);

foreach ($list as $item)
{
    if (checkOverlay($item)) {
        echo "\"{$item}\" => наложения нет". PHP_EOL;
    } else {
        echo "\"{$item}\" => произошло наложение". PHP_EOL;
    }
}
