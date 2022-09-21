<?php


    include_once 'apiJson.php';

    $api = new ApiJson();

    // print_r($api->getAll());

    $api->getOne(2);


    // include_once 'apiMovies.php';


    // $api = new ApiMovies();

    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];

    //     if(is_numeric($id)){

    //         $api->getMovie($id);
            
    //     }else{

    //         $api->printError('El parametro es incorrecto', 404);
        
    //     }
    // }else{

    //     $api->getAllMovies();
    
    // }
