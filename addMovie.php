<?php

    include_once 'apiMovies.php';


    $api = new ApiMovies();


    if(isset($_POST['title']) && isset($_FILES['img'])){
        if($api->saveImage($_FILES['img'])){
            $item = array(
                'title' => $_POST['title'],
                'img' => $api->getImgName(),
            );
            
            $api->addMovie($item);
            $api->printSuccess('Se creo el registro correctamente', 200);
        }else{
            $api->printError('Error con el archivo: ' . $api->getError(), 404);
        }
    }else{
        $api->printError('Error al llamar a la API', 500);
    }