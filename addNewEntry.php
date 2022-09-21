<?php


    include_once 'apiJson.php';

    if(isset($_POST['title']) && isset($_FILES['img'])){

        $api = new ApiJson();

        if($api->saveImage($_FILES['img'])){
            $item = array(
                'title' => $_POST['title'],
                'img' => $api->getImgName(),
            );
            
            $api->addNewEntry($item);
            $api->printSuccess('Se agrego la entrada correctamente');
        }else{
            $api->printError('Error con el archivo'. $api->getError());
        }
    }else{
        $api->printError('Error al llamar a la API');
    }