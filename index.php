<?php


include_once 'apiJson.php';

$api = new ApiJson();

header('Content-Type: application/json');


/* A switch statement that is checking the request method.  */
switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        //Valida si se esta buscando un elemento en particular
        if(isset($_GET['id'])){
            //Valida que el id ingresado sea un numero
            if(!is_numeric($_GET['id'])){
                print(json_encode($api->errors->error_400("El parametro es incorrecto")));
                die;
            }
            $api->getOne($_GET['id']);
        }else{
            print_r($api->getAll());
        }
        break;
    case 'POST':
        $data = file_get_contents("php://input");
        $api->addNewEntry($data);
        break;
    case 'PUT':
        $data = file_get_contents("php://input");
        $api->updateEntry($data);
        break;
    case 'DELETE':
        $data = file_get_contents("php://input");
        $api->deleteEntry($data);
        break;
    default:
        print(json_encode($api->errors->error_400()));
    break;
}