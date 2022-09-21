<?php


    include_once 'apiJson.php';

    $api = new ApiJson();


    if( isset($_GET['id'] )){
        
        $id = $_GET['id'];

        if(!is_numeric($id)){
            $api->printError('El parametro es incorrecto');
        }

        $api->getOne($id);

    }else{

        print_r($api->getAll());
    
    }
