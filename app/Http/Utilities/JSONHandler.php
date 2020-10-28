<?php

namespace App\Http\Utilities;

class JSONHandler
{
    public static function emptyJSONPackage()
    {
        return [
            "resultStatus" => [
                "isSuccess" => false,
                "errorMessage" => "NOT_INSTANTIATED",
            ],
            "resultData" => []
        ];
    }

    public static function emptySuccessfulJSONPackage()
    {
        return [
            "resultStatus" => [
                "isSuccess" => true,
                "errorMessage" => "",
            ],
            "resultData" => []
        ];
    }

    public static function errorJSONPackage($errorMessage)
    {
        $jsonPackage = JSONHandler::emptyJSONPackage();
        $jsonPackage["resultStatus"]["errorMessage"] = $errorMessage;

        return $jsonPackage;
    }

    public static function packagedJSONData($data)
    {
        $jsonPackage = JSONHandler::emptySuccessfulJSONPackage();

        $jsonPackage["resultData"] = $data;

        return $jsonPackage;
    }
}