<?php


class DBJSON {
    
    private $jsonFile;

    public function __construct()
    {   
        $this->jsonFile = "json.json"; // Path to JSON file
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
    function orderData($arrayNewItem){
        //Obtiene toda la informacion que contien el archivo en formato de array
        $fullData = json_decode($this->getContentJson(), true);
        //Obtiene el ID del ultimo elemento
        $lastID = end($fullData['items'])['id'];
        //array donde se agrega el ID para el nuevo elemento
        $id = array(
            'id' => $lastID + 1
        );
        //Se hace un merge entre los dos arrays($arrayNewItem, $id)
        $resultMerge = array_merge($id, $arrayNewItem);

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
    public function saveNewData($arrayItem){
        //Ordena y agrega la nueva entrada
        $dataToJson = $this->orderData($arrayItem);

        //Se abre el archivo para edicion
        $file = fopen($this->jsonFile, 'w');
        //Se escribe la nueva informacion
        fwrite($file, $dataToJson);
        //Se cierra el archivo
        fclose($file);
    }
}