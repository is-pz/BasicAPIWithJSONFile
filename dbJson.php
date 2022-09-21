<?php


class DBJSON {
    
    private $jsonFile;

    public function __construct($nameJsonFile)
    {   
        $this->jsonFile = $nameJsonFile;
    }

    public function getContentJson(){
        $jsonFileName = $this->jsonFile;
        $dataFile = file_get_contents($jsonFileName);
        return $dataFile;
    }

    function orderData($arrayItem){
        $fullData = json_decode($this->getContentJson(), true);
        $lastID = end($fullData['items'])['id'];
        $id = array(
            'id' => $lastID + 1
        );
        $resultMerge = array_merge($id, $arrayItem);

        array_push($fullData['items'], $resultMerge);
        return (json_encode($fullData));
    }

    public function saveNewData($arrayItem){
        
        $dataToJson = $this->orderData($arrayItem);

        $file = fopen($this->jsonFile, 'w');
        fwrite($file, $dataToJson);
        fclose($file);
    }
}