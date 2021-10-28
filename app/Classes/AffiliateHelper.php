<?php

namespace App\Classes;

use App\Classes\Geo\Coordinates;
use App\Classes\Affiliate;
use App\Classes\AffiliateList;

class AffiliateHelper
{

    /**
     * Creates an affiliate object from a json string and tests if the object is 
     * within the desired range in KM.
     * @static
     * 
     * @param string $affiliateString
     * @param Coordinates $coordinates
     * @param float $rangeInKm
     * @param AffiliateList &$affiliateList
     * @param int &$parseError
     * 
     * @return float
     */
    public static function isInRangeDataInJsonString(
        string $affiliateString,
        Coordinates $coordinates,
        float $rangeInKm,
        AffiliateList &$affiliateList, 
        int &$parseError
    ) {
        $affiliate = new Affiliate();
        if ($affiliate->validateFromJsonString($affiliateString)) {
            $distance = $affiliate->getDistanceFromCoordinates($coordinates);
            if ($distance <= $rangeInKm) {
                $affiliateList->add($affiliate->getName(), $affiliate->getId());
            }
        } else {
            $parseError++;
        }
    }

}