<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Classes\Geo\Coordinates;
use App\Classes\AffiliateHelper;
use App\Classes\AffiliateList;
use App\Classes\Affiliate;

class AffiliateHelperTest extends TestCase
{
    public function test_parsing()
    {
        $parseError = 0;
        $affiliateList = new AffiliateList();
        AffiliateHelper::isInRangeDataInJsonString(
            '{"latitude": "52.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.043701"}',
            new Coordinates(53.3340285, -6.2535495),
            100,
            $affiliateList,
            $parseError
        );
        $this->assertEquals(0, $parseError);  
    }

    public function test_parsing_error()
    {
        $parseError = 0;
        $affiliateList = new AffiliateList();
        AffiliateHelper::isInRangeDataInJsonString(
            '{"latitude": "52.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.043701}',
            new Coordinates(53.3340285, -6.2535495),
            100,
            $affiliateList,
            $parseError
        );
        $this->assertEquals(1, $parseError);
    }

    public function test_2_in_range_and_2_outside()
    {
        $parseError = 0;
        $affiliateList = new AffiliateList();
        AffiliateHelper::isInRangeDataInJsonString(
            '{"latitude": "51.8856167", "affiliate_id": 2, "name": "Mohamed Bradshaw", "longitude": "-10.4240951"}',
            new Coordinates(53.3340285, -6.2535495),
            100,
            $affiliateList,
            $parseError
        );
        AffiliateHelper::isInRangeDataInJsonString(
            '{"latitude": "52.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.043701"}',
            new Coordinates(53.3340285, -6.2535495),
            100,
            $affiliateList,
            $parseError
        );
        AffiliateHelper::isInRangeDataInJsonString(
            '{"latitude": "52.3191841", "affiliate_id": 3, "name": "Rudi Palmer", "longitude": "-8.5072391"}',
            new Coordinates(53.3340285, -6.2535495),
            100,
            $affiliateList,
            $parseError
        );
        AffiliateHelper::isInRangeDataInJsonString(
            '{"latitude": "54.133333", "affiliate_id": 24, "name": "Ellena Olson", "longitude": "-6.433333"}',
            new Coordinates(53.3340285, -6.2535495),
            100,
            $affiliateList,
            $parseError
        );
        $list = $affiliateList->getSortedByIdAsc();
        $this->assertEquals(2, sizeof($list));
        $this->assertEquals(12, $list[0]['affiliate_id']);
        $this->assertEquals(24, $list[1]['affiliate_id']);
        $this->assertEquals(0, $parseError);
    }

}
