<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use App\Classes\FileReader;
use App\Classes\Office;
use App\Classes\AffiliateList;
use App\Classes\AffiliateHelper;

class AffiliateUploadFileController extends Controller
{
    
    /**
     * Process an uploaded file with affiliates and return the affiliates
     * that are without 100 Km of the office.
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required'
        ]);

        $parseError = 0;
        $affiliateList = new AffiliateList();

        FileReader::oneLineAtATime(
            $request->file->getRealPath(),
            function($affiliateString) use (&$affiliateList, &$parseError){
                AffiliateHelper::isInRangeDataInJsonString(
                    $affiliateString,
                    Office::getCoordinates(),
                    100,
                    $affiliateList, 
                    $parseError
                );
            }
        );
        
        return response()->json([
            'parseError' => $parseError,
            'results' => $affiliateList->getSortedByIdAsc()
        ]);
    }

}
