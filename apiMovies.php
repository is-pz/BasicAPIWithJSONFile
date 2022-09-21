<?php


include_once 'movies.php';

class ApiMovies {

    private $img;
    private $erro;

    /**
     * It prints the JSON encoded version of the array.
     * 
     * @param array The array to be encoded.
     */
    function printJSON($array){
        echo '<code>' . json_encode($array) . '</code>';
    }

   /**
    * It takes a message and a status and returns a JSON object with the message and status.
    * 
    * @param message The message to be displayed.
    * @param status The status of the request.
    */
    function printError($message, $status){
        echo '<code>'. json_encode(array('Message' => $message, 'Status' => $status)). '</code>';
    }

   /**
    * It takes a message and a status and returns a JSON object with the message and status.
    * 
    * @param message The message you want to display
    * @param status The status of the request.
    */
    function printSuccess($message, $status){
        echo '<code>'. json_encode(array('Message' => $message, 'Status' => $status)). '</code>';
    }

    /**
     * It gets all the movies from the database and returns them in a JSON format.
     */
    function getAllMovies(){
        $movie = new Movies();
        $movies = array();
        $movies['items'] = array(); 

        $result = $movie->getMovies();

        if( $result->rowCount() > 0 ){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $item = array(
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'image' => $row['img']
                );
                array_push($movies['items'], $item);
            }
            
            $this->printJSON($movies);

        }else{
            $this->printError('No existen elementos', 404);
        }
    }
    
    
    /**
     * It gets a movie from the database and returns it as a JSON object.
     * 
     * @param id The id of the movie you want to get.
     */
    function getMovie($id){
        $movie = new Movies();
        $movies = array();
        $movies['items'] = array(); 

        $result = $movie->getMovie($id);

        if( $result->rowCount() == 1 ){
            $row = $result->fetch();

            $item = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'image' => $row['img']
            );
            array_push($movies['items'], $item);
            
            $this->printJSON($movies);

        }else{
            $this->printError('No registrado', 404);
        }
    }


    function addMovie($item){
        $movie = new Movies();
        $result = $movie->newMovie($item);
        
        $this->printSuccess('Nueva registro añadido', 200);

    }


    function saveImage($file){
        $directory = "img/";

        $this->img = basename($file["name"]);
        $archivo = $directory . basename($file["name"]);

        $typeFile = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    
        // valida que es img
        $checarSiimg = getimagesize($file["tmp_name"]);

        if($checarSiimg != false){
            //validando tamaño del archivo
            $size = $file["size"];

            if($size > 500000){
                $this->error = "El archivo tiene que ser menor a 500kb";
                return false;
            }else{

                //validar tipo de img
                if($typeFile == "jpg" || $typeFile == "jpeg"){
                    // se validó el archivo correctamente
                    if(move_uploaded_file($file["tmp_name"], $archivo)){
                        //echo "El archivo se subió correctamente";
                        return true;
                    }else{
                        $this->error = "Hubo un error en la subida del archivo";
                        return false;
                    }
                }else{
                    $this->error = "Solo se admiten archivos jpg/jpeg";
                    return false;
                }
            }
        }else{
            $this->error = "El documento no es una imagen";
            return false;
        }
    }

    
    function getImgName(){
        return $this->img;
    }


    function getError(){
        return $this->error;
    }

}