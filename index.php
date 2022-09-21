<?php


    include_once 'apiJson.php';

    $api = new ApiJson();

    //Se verifica si se esta buscando un elemento
    if( isset($_GET['id'] )){
        
        $id = $_GET['id'];

        //Se verifica si es un numero
        if(!is_numeric($id)){
            $api->printError('El parametro es incorrecto');
        }
        //Se regresa el elemento buscado
        $api->getOne($id);

    }else{

        //Se regresan todos los elementos
        print_r($api->getAll());
    }
