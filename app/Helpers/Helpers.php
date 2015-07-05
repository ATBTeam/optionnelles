<?php
/**
 * Created by PhpStorm.
 * User: ALIENWARE!
 * Date: 05/07/2015
 * Time: 19:53
 */

namespace App\Helpers;

class Helpers {

    public static function ConvertDateString($dateString)
    {   //2013-10-09T15:38:00
        $myDateTime=strftime('%Y-%m-%dT%H:%M:%S', strtotime($dateString));
        return $myDateTime;
    }

}