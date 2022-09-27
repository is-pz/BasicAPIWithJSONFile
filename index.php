<?php


include_once 'apiJson.php';

$api = new ApiJson();

header('Content-Type: application/json');


switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['id'])){
            //Valida que el id ingresado sea un numero
            if(!is_numeric($_GET['id'])){
                $api->printError('El parametro es incorrecto');
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
        //Error message
    break;
}