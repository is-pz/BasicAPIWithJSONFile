<?php


class DBJSON {
    
    private $jsonFile;

    public function __construct($nameJsonFile)
    {   
        $this->jsonFile = $nameJsonFile;
    }
    

    public function getData(){
        $jsonFileName = $this->jsonFile;
        $dataFile = file_get_contents($jsonFileName);
        return $dataFile;
    }


}