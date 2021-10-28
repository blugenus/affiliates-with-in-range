<?php

namespace App\Classes;

use App\Classes\Geo\Coordinates;

class Office
{
    /**
     * Geo coordinates of the office
     * @static
     *
     * @var Coordinates
     */
    private static Coordinates $coordinates;

    /**
     * Return the office's coordinates
     * @static
     * 
     * @return Coordinates
     */
    public static function getCoordinates(): Coordinates
    {
        if (!isset(self::$coordinates)) {
            self::$coordinates = new Coordinates(53.3340285, -6.2535495);
        }
        return self::$coordinates;
    }

}