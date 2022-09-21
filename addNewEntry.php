<?php


    include_once 'apiJson.php';
    
    $api = new ApiJson();
    
    //Valida que vengan los datos
    if(!isset($_POST['title']) && !isset($_FILES['img'])){
        
        $api->printError('Error al llamar a la API');
        die;
    }

    //Se intenta guardar la imagen
    if(!$api->saveImage($_FILES['img'])){

        $api->printError('Error con el archivo'. $api->getError());
        die;
    }

    //Se crea la estructura de elemento para el archivo json
    $item = array(
        'title' => $_POST['title'],
        'img' => $api->getImgName(),
    );
    
    $api->addNewEntry($item);
    $api->printSuccess('Se agrego la entrada correctamente');