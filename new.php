<?php

/**
 * Converts a GMT date and time to PST/PDT time zone
 *
 * @param string $date Date in the format 'Y-m-d' (e.g., '2021-03-16')
 * @param string $time Time in the format 'H:i:s' (e.g., '23:34:00')
 * @return array An array with two elements: [0] => adjusted date, [1] => adjusted time
 */
function convertToLocalTime($date, $time)
{
    // Create a DateTime object with the GMT date and time
    $gmtDateTime = new DateTime($date . ' ' . $time, new DateTimeZone('GMT'));

    // Get the timezone for the Pacific region
    $tz = new DateTimeZone('America/Los_Angeles');

    // Adjust the DateTime object to the Pacific timezone
    $gmtDateTime->setTimezone($tz);

    // Get the offset from GMT for the current time
    $offset = $tz->getOffset($gmtDateTime) / 3600;

    // Determine if it's currently PDT (-7 hours) or PST (-8 hours)
    $isDaylightSavingTime = $offset == -7;

    // Format the adjusted date and time
    $adjustedDate = $gmtDateTime->format('Y-m-d');
    $adjustedTime = $gmtDateTime->format('H:i:s');

    // Append the time zone information to the time
    $timeZone = $isDaylightSavingTime ? 'PDT' : 'PST';
    $adjustedTime .= ' ' . $timeZone;

    // Return the adjusted date and time as an array
    return [$adjustedDate, $adjustedTime];
}

$gmtDate = '2021-03-16';
$gmtTime = '23:34:00';
list($localDate, $localTime) = convertToLocalTime($gmtDate, $gmtTime);
echo "Date: $localDate, Time: $localTime";
// Output: Date: 2021-03-16, Time: 15:34:00 PDT