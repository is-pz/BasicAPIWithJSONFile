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
    
    

}