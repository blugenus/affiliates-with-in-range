<?php

namespace App\Classes\Geo;

class SphericalDistance
{

    /**
     * Mean Earth Radius
     * 
     * @vars float
     */
    public const MEAN_EARTH_RADIUS = 6371.009;

    /**
     * Returns the distance in KM.
     * @static
     * 
     * @param Coordinates $latitude
     * @param Coordinates $longitude
     * 
     * @return float
     */
    public static function getBetweenTwoSetsOfCoordinates(Coordinates $coord1, Coordinates $coord2): float
    {
        $lngAbsoluteDifference = $coord1->getLongitudeInRadian() - $coord2->getLongitudeInRadian();
        $angle = cos($coord1->getLatitudeInRadian());
        $angle *= cos($coord2->getLatitudeInRadian()); 
        $angle *= cos($lngAbsoluteDifference);
        $angle += sin($coord1->getLatitudeInRadian()) * sin($coord2->getLatitudeInRadian());
        $angle = acos($angle);
        return static::getFromCentralAngle($angle);
    }

    /**
     * Returns the distance in KM.
     * @static
     * 
     * @param float $angle
     * 
     * @return float
     */
    public static function getFromCentralAngle(float $angle): float
    {
        return static::MEAN_EARTH_RADIUS * $angle;
    }

}