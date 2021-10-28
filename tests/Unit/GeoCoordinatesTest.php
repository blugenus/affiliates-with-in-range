<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Classes\Geo\Coordinates;

class GeoCoordinatesTest extends TestCase
{
    public function test_created_from_number()
    {
        $this->assertInstanceOf(
            Coordinates::class, 
            new Coordinates(53.3340285, -6.2535495)
        );
    }

    public function test_latitude()
    {
        $coord = new Coordinates(53.3340285, -6.2535495);
        $this->assertEquals(53.3340285, $coord->getLatitude());
    }

    public function test_latitude_in_radians()
    {
        $coord = new Coordinates(53.3340285, -6.2535495);
        $this->assertEquals(deg2rad(53.3340285), $coord->getLatitudeInRadian());
    }

    public function test_longitude()
    {
        $coord = new Coordinates(53.3340285, -6.2535495);
        $this->assertEquals(-6.2535495, $coord->getLongitude());
    }

    public function test_longitude_in_radians()
    {
        $coord = new Coordinates(53.3340285, -6.2535495);
        $this->assertEquals(deg2rad(-6.2535495), $coord->getLongitudeInRadian());
    }
}
