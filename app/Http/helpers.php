<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.02.2017
 * Time: 0:54
 */

//this function convert string to UTC time zone
function convertTimeToUTCzone($str, $userTimezone, $format = 'Y-m-d H:i:s'){
    $new_str = new DateTime($str, new DateTimeZone($userTimezone));
    $new_str->setTimeZone(new DateTimeZone('UTC'));
    return $new_str->format( $format);
}

//this function converts string from UTC time zone to current user timezone
function convertTimeToUSERzone($str, $userTimezone, $format = 'Y-m-d'){
    if(empty($str)){
        return '';
    }
    $new_str = new DateTime($str, new DateTimeZone('UTC') );
    $new_str->setTimeZone(new DateTimeZone( $userTimezone ));
    return $new_str->format( $format);
}
/* Takes a GMT offset (in hours) and returns a timezone name */
function tz_offset_to_name($offset)
{
    $offset *= -60; // convert hour offset to seconds
    $abbrarray = timezone_abbreviations_list();
    foreach ($abbrarray as $abbr)
    {
        foreach ($abbr as $city)
        {
            if ($city['offset'] == $offset)
            {
                return $city['timezone_id'];
            }
        }
    }
    return false;
}
function getTimeZoneNameByOffset($offset){
    $offset *= -60;
    $timeZoneNameByOffset = timezone_name_from_abbr("", $offset, 0);
    return $timeZoneNameByOffset;
}
