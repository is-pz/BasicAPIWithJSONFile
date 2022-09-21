<?php

include_once 'dbJson.php';

class ApiJson extends DBJSON{

    private $img;
    private $error;
    
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

    function addNewEntry($item){
        $this->jsonFile->saveNewData($item);
    }


    
    function saveImage($file){
        $directory = "img/";

        $this->img = basename($file["name"]);
        $archivo = $directory . basename($file["name"]);

        $typeFile = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    
        // valida que es img
        $checarSiimg = getimagesize($file["tmp_name"]);

        if($checarSiimg != false){
            //validando tamaño del archivo
            $size = $file["size"];

            if($size > 500000){
                $this->error = "El archivo tiene que ser menor a 500kb";
                return false;
            }else{

                //validar tipo de img
                if($typeFile == "jpg" || $typeFile == "jpeg"){
                    // se validó el archivo correctamente
                    if(move_uploaded_file($file["tmp_name"], $archivo)){
                        //echo "El archivo se subió correctamente";
                        return true;
                    }else{
                        $this->error = "Hubo un error en la subida del archivo";
                        return false;
                    }
                }else{
                    $this->error = "Solo se admiten archivos jpg/jpeg";
                    return false;
                }
            }
        }else{
            $this->error = "El documento no es una imagen";
            return false;
        }
    }

    
    function getImgName(){
        return $this->img;
    }


    function getError(){
        return $this->error;
    }
}