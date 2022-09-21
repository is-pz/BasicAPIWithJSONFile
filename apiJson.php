<?php

include_once 'dbJson.php';

class ApiJson extends DBJSON{
    
    private $jsonFile;
    private $nameJsonFile = "json.json";

    public function __construct()
    {   
        $this->jsonFile = new DBJSON($this->nameJsonFile);
    }
    
    function getAll(){
        return $this->jsonFile->getContentJson();
    }
    
    function getOne($id){
        $jsonToArray = json_decode($this->jsonFile->getContentJson(), true);
        $itemToReturn = array();
        $itemToReturn['item'] = array();
        $fakeRow = current(array_filter($jsonToArray['items'], function ($v) use ($id){
            return $v['id'] == $id;
        }, ARRAY_FILTER_USE_BOTH));
         
        
        array_push($itemToReturn['item'], $fakeRow);

        print(json_encode($itemToReturn));

    }

}