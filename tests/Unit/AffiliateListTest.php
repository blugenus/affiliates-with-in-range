<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Classes\AffiliateList;

class AffiliateListTest extends TestCase
{

    public function test_sorting_by_id_asc()
    {
        $affiliateList = new AffiliateList();
        $affiliateList->add('A',10);
        $affiliateList->add('B',1);
        $affiliateList->add('C',100);
        $list = $affiliateList->getSortedByIdAsc();
        $this->assertEquals(1, $list[0]['affiliate_id']);
        $this->assertEquals(10, $list[1]['affiliate_id']);
        $this->assertEquals(100, $list[2]['affiliate_id']);
    }

    public function test_no_of_affiliates_in_list()
    {
        $affiliateList = new AffiliateList();
        $affiliateList->add('A',10);
        $affiliateList->add('B',1);
        $affiliateList->add('C',100);
        $list = $affiliateList->getSortedByIdAsc();
        $this->assertEquals(3, sizeof($list));
    }

    public function test_empty_array()
    {
        $affiliateList = new AffiliateList();
        $list = $affiliateList->getSortedByIdAsc();

        $this->assertEquals(0, sizeof($list));
    }
}
