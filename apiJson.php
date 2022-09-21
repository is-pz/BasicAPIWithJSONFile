<?php

include_once 'dbJson.php';
include_once 'saveImage.php';

class ApiJson extends DBJSON{
    
    private $jsonFile;
    private $nameJsonFile = "json.json";
    private $save;

    public function __construct()
    {   
        $this->jsonFile = new DBJSON($this->nameJsonFile);
        $this->saveImage = new SaveImage();
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

        $this->printJSON($itemToReturn);

    }


    function printJSON($array){
        echo '<code>' . json_encode($array) . '</code>';
    }

  
    function printError($message){
        echo '<code>'. json_encode(array('Message' => $message)) . '</code>';
    }

   
    function printSuccess($message){
        echo '<code>'. json_encode(array('Message' => $message)) . '</code>';
    }


    function addNewEntry($item){
        $this->jsonFile->saveNewData($item);
    }


    function saveImage($file){ 
      return $this->save->saveImage($file);
    }

    
    function getImgName(){
        return $this->save->getImg();
    }


    function getError(){
        return $this->save->getError();
    }
}