<?php

include_once 'dbJson.php';

class ApiJson extends DBJSON{
    
    private $jsonFile;

    public function __construct()
    {   
        $this->jsonFile = new DBJSON('json.json');
    }
    
    function getAll(){
        return $this->jsonFile->getContentJson();
    }
    
    function getOne($id){
        $jsonToArray = json_decode($this->jsonFile->getContentJson(), true);
        $itemSearch['item'] = current(array_filter($jsonToArray['items'], function ($v) use ($id){
            return $v['id'] == $id;
        }, ARRAY_FILTER_USE_BOTH));
        
        $itemSearch = json_encode($itemSearch);
        print($itemSearch);
    }

}