<?php

namespace App\Classes\Geo;

class Coordinates
{

    /**
     * latitude
     *
     * @var float
     */
    private float $latitude;

    /**
     * longitude
     *
     * @var float
     */    
    private float $longitude;

    /**
     * Class Constructor
     * 
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * Returns the latitude in degrees.
     *
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * Returns the longitude in degrees.
     *
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * Returns the latitude in radian.
     *
     * @return float
     */
    public function getLatitudeInRadian(): float
    {
        return deg2rad($this->latitude);
    }

    /**
     * Returns the longitude in radian.
     *
     * @return float
     */
    public function getLongitudeInRadian(): float
    {
        return deg2rad($this->longitude);
    }

}