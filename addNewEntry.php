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
        }
        

    }