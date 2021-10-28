<?php

namespace App\Classes;

use App\Classes\Geo\Coordinates;
use App\Classes\Geo\SphericalDistance;

use Illuminate\Support\Facades\Validator;

class Affiliate
{

    /**
     * Id of the affiliate
     *
     * @var int
     */
    private int $id = 0;

    /**
     * Name of the affiliate
     *
     * @var string
     */
    private string $name = '';

    /**
     * Coordinates of the affiliate
     *
     * @var Coordinates
     */
    private Coordinates $coordinates;

    /**
     * if the affiliate's data is valid
     *
     * @var bool
     */
    private bool $valid = false;

    /**
     * Returns if the data is valid.
     * 
     * @param string $affiliate
     * 
     * @return bool
     */
    public function validateFromJsonString(string $affiliate): bool
    {
        if ($array = json_decode($affiliate, true)) {
            return $this->validateFromArray($array);
        }
        return false;
    }

    /**
     * Returns if the data is valid.
     * 
     * @param array $affiliate
     * 
     * @return bool
     */
    public function validateFromArray(array $affiliate): bool
    {
        $validator = Validator::make($affiliate, [
            'affiliate_id' => 'required|integer',
            'name' => 'required',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        if (!$validator->fails()) {
            $this->valid = true;
        }

        $this->affiliate = $validator->validated();
        return $this->isValid();
    }

    /**
     * Returns if the data is valid.
     * 
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * Returns the coordinates of the affiliate.
     * 
     * @return Coordinates
     */
    public function getCoordinates(): Coordinates
    {
        return new Coordinates(
            $this->affiliate['latitude'], 
            $this->affiliate['longitude']
        );
    }

    /**
     * Returns the Name of the affiliate.
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->affiliate['name'];
    }

    /**
     * Returns the Id of the affiliate.
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->affiliate['affiliate_id'];
    }

    /**
     * Returns the distance in KM between this affiliate 
     * and the coordinates submited.
     * 
     * @param Coordinates coordinates
     * 
     * @return float
     */
    public function getDistanceFromCoordinates(Coordinates $coordinates): float
    {
        return SphericalDistance::getBetweenTwoSetsOfCoordinates(
            $this->getCoordinates(),
            $coordinates
        );
    }

}