<?php


    include_once 'apiJson.php';
    
    $api = new ApiJson();
    
    if(!isset($_POST['title']) && !isset($_FILES['img'])){
        
        $api->printError('Error al llamar a la API');
        die;
    }


    if(!$api->saveImage($_FILES['img'])){

        $api->printError('Error con el archivo'. $api->getError());
        die;
    }


    $item = array(
        'title' => $_POST['title'],
        'img' => $api->getImgName(),
    );
    
    $api->addNewEntry($item);
    $api->printSuccess('Se agrego la entrada correctamente');