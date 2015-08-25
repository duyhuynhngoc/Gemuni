<?php
/**
 * Code Owner: CCIntegration Inc. S.P.I.D.E.R framework
 * Modified date: 8/25/2015
 * Modified by: Duy Huynh
 */

namespace Gemuni\Datetime;


class Time {
    const TIME_12_FORMAT = "/((0[0-9])|1[0-2]):([0-5][0-9]):([0-5][0-9])(AM|PM)/"; //HH:MM:SSAM
    const TIME_24_FROMAT = "/((0[0-9])|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])/";
    /**
     * convert 12 hour format to 24 hour format
     * Midnight: 12:00:00AM, 00:00:00
     * Noon: 12:00:00PM
     * Input:
     *  1. type: string
     *  2. constranst:
     *     1<= hh<=12, 0<=mm<=59, 0<=ss<=59
     * Output:
     *  1. type: string
     *  2. constranst:
     *      0<=hh<=23; 0<=mm<=59, 0<=ss<=59
     * @param $timeString
     * @param $format
     */
    public static function convert24Hour($timeString)
    {
        if(preg_match(self::TIME_12_FORMAT, $timeString))
            return false;

        $arr = preg_split("/[:]/", $timeString);
        $sufix = substr($arr[2], strlen($arr[2]) - 2);
        $hh = (int)$arr[0];

        if($sufix == "AM"){
            $arr[0] = $hh == 12?"00":($hh < 10?"0".$hh:$hh);
        }else{
            $hh  += 12;
            $arr[0] = ($hh == 24)?12:$hh;
        }
        $arr[2] = substr($arr[2], 0, 2);

        return implode(":", $arr);
    }
}