<?php
namespace CarInventory\data;

class DataTransferObject
{
    private $dataDirectory;

    public function __construct()
    {
        $this->dataDirectory = __DIR__;
    }

    public function fetchData($fileName)
    {
        $filePath = $this->dataDirectory . '/' . $fileName;

        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            return json_decode($jsonData, true);
        } else {
            throw new \Exception("File not found: $fileName");
        }
    }
}
