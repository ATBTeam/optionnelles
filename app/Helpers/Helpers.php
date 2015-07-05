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
    {
        $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
        $newDateString = $myDateTime->format('d/m/Y H:i:s');
        return $newDateString;
    }

}