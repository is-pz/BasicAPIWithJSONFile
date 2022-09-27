<?php

include_once 'dbJson.php';
include_once 'saveImage.php';
include_once 'response.php';

class ApiJson extends DBJSON{
    
    private $jsonFile;
    
    private $save;

    public $response;

    public function __construct()
    {   
        $this->jsonFile = new DBJSON();
        $this->save = new SaveImage();
        $this->response = new Response();
    }
    
    
    /**
     * It returns the content of the JSON file with the format it has.
     * 
     * @return string The content of the JSON file with the format it has.
     */
    function getAll(){
        //Regresa el contenido del archivo JSON con el formato que tiene
        return $this->jsonFile->getContentJson();
    }
    

    /**
     * It takes the json file, converts it to an array, filters the array to find the item with the id
     * passed as a parameter, and returns the item found as json
     * 
     * @param int id The id of the item to be retrieved
     * 
     * @return <code>{
     *     "item": [
     *         {
     *             "id": "1",
     *             "title": "title",
     *             "description": "description",
     *             "image": "image.jpg",
     *             "price": "100",
     *             "stock": "10"
     *         }
     *     ]
     * }
     * </code>
     */
    function getOne($id){
        //Se convierte el contenido json a un array
        $jsonToArray = json_decode($this->jsonFile->getContentJson(), true);
        
        //Se filtra el array en busca del item buscado y se regresa solo los valores clave/valor ejem: ['id'] => '1', ['title] => 'title'
        $row = current(array_filter($jsonToArray['items'], function ($v) use ($id){
            return $v['id'] == $id;
        }, ARRAY_FILTER_USE_BOTH));
         
        if(!empty($row) || $row != null){
            
            $itemToReturn = array();

            //Se añade la clave 'item' al array
            $itemToReturn['item'] = array();

            //Se añade al array el elemento encontrado
            array_push($itemToReturn['item'], $row);
            
            $this->printJSON($itemToReturn);

        }else{
            $this->response->error_200('No se econtro el registro');
        }
    }


    /**
     * It prints the JSON encoded version of the array.
     * 
     * @param array The array to be encoded.
     */
    function printJSON($array){
        echo '<code>' . json_encode($array) . '</code>';
    }


    /**
     * This function takes an item and saves it to a file.
     * 
     * @param string jsonData The item to be added to the JSON file.
     */
    function addNewEntry($jsonData){
        print($this->jsonFile->saveNewData($jsonData));
    }


   /**
    * The function updateEntry() takes a JSON object as a parameter, and then calls the updateEntry()
    * function of the jsonFile object, which is a member of the class, and then prints the result of
    * that function.
    * 
    * @param string jsonData The JSON data to be updated.
    */
    function updateEntry($jsonData){
        print($this->jsonFile->updateEntry($jsonData));
    }



    /**
     * Delete an entry from the JSON file.
     * 
     * @param string jsonData The data to be written to the file.
     */
    function deleteEntry($jsonData){
        print($this->jsonFile->deleteEntry($jsonData));
    }


    /**
     * It takes a file, and saves it to the server.
     * 
     * @param file The file to be saved.
     * 
     * @return bool The return value of the saveImage method of the save object.
     */
    function saveImage($file){ 
      return $this->save->saveImage($file);
    }

    
    /**
     * It returns the name of the image that was saved.
     * 
     * @return string The return value of the method getImg() of the object ->save.
     */
    function getImgName(){
        return $this->save->getImg();
    }


    /**
     * It returns the error message from the save class.
     * 
     * @return string The error message.
     */
    function getError(){
        return $this->save->getError();
    }
}