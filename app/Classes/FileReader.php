<?php

namespace App\Classes;

class FileReader
{

    /**
     * Opens and reads a file line by line. It executes the function submited for 
     * each line read and passes the line as the function's paramenter
     * @static
     * 
     * @param string $file
     * @param function $function
     */
    public static function oneLineAtATime(string $file, $function)
    {
        $fileStream = fopen($file, "r");

        while(!feof($fileStream)) {
            $affiliateString = fgets($fileStream);
            $function($affiliateString);
        }
        fclose($fileStream);
    }

}