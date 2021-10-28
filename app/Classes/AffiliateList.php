<?php

namespace App\Classes;

class AffiliateList
{

    /**
     * Aray of affiliates names and ids
     *
     * @var array
     */
    private array $affiliates = [];

    /**
     * Adds an affiliate to the list
     * 
     * @param string $name
     * @param int $id
     */
    public function add(string $name, int $id) 
    {
        $this->affiliates[] = [
            'name' => $name,
            'affiliate_id' => $id
        ];
    }

    /**
     * Sort the affilate list by id asc and returns it.
     * 
     * @return array
     */
    public function getSortedByIdAsc():array 
    {
        usort($this->affiliates, function($a, $b){
            return $a['affiliate_id'] <=> $b['affiliate_id'];
        });
        return $this->affiliates;
    }

}