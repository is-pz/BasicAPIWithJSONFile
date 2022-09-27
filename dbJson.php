<?php


class DBJSON {
    
    private $jsonFile;

    public function __construct()
    {   
        $this->jsonFile = "json.json"; // Path to JSON File
    }

   /**
    * It gets the content of a JSON file.
    * 
    * @return string The content of the file.
    */
    public function getContentJson(){
        $pathJsonFile = $this->jsonFile;
        //Obtiene el contenido del archivo JSON
        $contentFile = file_get_contents($pathJsonFile);
        return $contentFile;
    }

    /**
     * It takes an array of data, gets the last ID from the JSON file, adds 1 to it, merges the new ID
     * with the array of data, and then returns the new JSON file.
     * 
     * @param array arrayNewItem This is the array that contains the new item to be added to the JSON file.
     * 
     * @return string the entire content of the file in json format.
     */
    private function orderData($jsonData){

        //Convierte el json en un array para agregar un id
        $jsonToArray = json_decode($jsonData, true);

        //Obtiene toda la informacion que contien el archivo en formato de array
        $fullData = json_decode($this->getContentJson(), true);
        //Obtiene el ID del ultimo elemento
        $lastID = end($fullData['items'])['id'];
        //array donde se agrega el ID para el nuevo elemento
        $id = array(
            'id' => $lastID + 1
        );
        //Se hace un merge entre los dos arrays($arrayNewItem, $id)
        $resultMerge = array_merge($id, $jsonToArray);

        //Se agrega el ultimo elemento al array fullData
        array_push($fullData['items'], $resultMerge);

        //Se retoran todo el contenido en formato json
        return (json_encode($fullData));
    }

    
    /**
     * It takes an array of data, orders it, and then writes it to a file.
     * 
     * @param array arrayItem The array of data to be added to the JSON file.
     */
    public function saveNewData($jsonData){
        //Ordena y agrega la nueva entrada
        $dataToJson = $this->orderData($jsonData);
        
        //Se guarda el archivo con la nueva informacion
        $this->saveFile($dataToJson);

        //Cambiar por respuesta http
        return $dataToJson;
    }

    
    /**
     * It takes a JSON string, decodes it to an array, then loops through the array and replaces the
     * values of the array with the values of the JSON string.
     * 
     * @param jsonData the json data that is sent from the client side.
     */
    public function updateEntry($jsonData){

        //Se convierte a array la informacion recivida
        $jsonToArray = json_decode($jsonData, true);

        //Se convierte en array todo el contenido de archivo json
        $fullDataToArray = json_decode($this->getContentJson(), true);
       
        //Se recorre el array en busca del id enviado y si existe se modifican los datos
        array_walk($fullDataToArray['items'], function(&$value) use ($jsonToArray){
            if( $value['id'] == $jsonToArray['id'] ){
                $value['title'] = $jsonToArray['title'];
                $value['image'] = $jsonToArray['image'];
            }
        });
      
        //Se convierte nuevamente todo el array en un json
        $fullDataToJson = json_encode($fullDataToArray);

        //Se guarda el archivo json con los nuevos datos
        $this->saveFile($fullDataToJson);

        //Cambiar por respuesta http
        print($fullDataToJson);
    }


   /**
    * It takes a JSON string, converts it to an array, then converts the entire JSON file to an array,
    * then walks through the array looking for the ID of the item to delete, then deletes the item,
    * then converts the array back to JSON, then saves the file, then prints the JSON.
    * 
    * @param string jsonData The JSON data that you want to delete.
    */
    public function deleteEntry($jsonData){
         
        //Se convierte a array la informacion recivida
         $jsonToArray = json_decode($jsonData, true);

         //Se convierte en array todo el contenido de archivo json
         $fullDataToArray = json_decode($this->getContentJson(), true);
        
         $keyItemToDelete = 0;

         //Se recorre el array en busca del id enviado y si existe obtiene la clave
         array_walk($fullDataToArray['items'], function($value, $key) use ($jsonToArray, &$keyItemToDelete){
             if( $value['id'] == $jsonToArray['id'] ){
                $keyItemToDelete = $key;
             }
         });

         //Se elimina la seccion especifica
         unset($fullDataToArray['items'][$keyItemToDelete]);
        
         //Se convierte nuevamente todo el array en un json
         $fullDataToJson = json_encode($fullDataToArray);
 
         //Se guarda el archivo json con los nuevos datos
         $this->saveFile($fullDataToJson);
 
         //Cambiar por respuesta http
         print($fullDataToJson);

    }

    /**
     * It opens a file, writes to it, and closes it
     * 
     * @param string jsonData The data to be written to the file.
     */
    public function saveFile($jsonData){
         //Se abre el archivo para edicion
         $file = fopen($this->jsonFile, 'w');
         //Se escribe la nueva informacion
         fwrite($file, $jsonData);
         //Se cierra el archivo
         fclose($file);
    }

}
