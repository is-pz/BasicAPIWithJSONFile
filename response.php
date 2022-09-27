<?php


class Response {


    private $response = [
        'status' => "",
        'result' => []
    ];


   /**
    * It returns a JSON object with a status of "error" and a result object with a code of 405 and a
    * message of "Method not allowed".
    * 
    * @return array The response is being returned as an array.
    */
    public function error_405(){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            'code' => "405",
            'message' => "Metodo no permitido"
        );
        return json_encode($this->response);
    }

   /**
    * It returns an array with a status of error and a result of an array with a code of 200 and a
    * message of whatever you pass to the function.
    * 
    * @param string message The message you want to display to the user.
    * 
    * @return array The response is being returned.
    */
    public function error_200($message = "Datos incorrectos"){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            'code' => "200",
            'message' => $message
        );
        return json_encode($this->response);
    }

    /**
    * It returns an array with a status of error and a result of an array with a code of 200 and a
    * message of whatever you pass to the function.
    * 
    * @param string message The message you want to display to the user.
    * 
    * @return array The response is being returned.
    */
    public function error_201($message = "Datos alamcenados correctamente"){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            'code' => "201",
            'message' => $message
        );
        return json_encode($this->response);
    }


    /**
     * It returns a JSON object with a status of "error" and a result object with a code of "400" and a
     * message of "Datos enviados incompletos o con formato incorrecto".
     * 
     * @return array The response is an array with two keys: status and result.
     */
    public function error_400(){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            'code' => "400",
            'message' => "Datos enviados incompletos o con formato incorrecto"
        );
        return json_encode($this->response);
    }


   /**
    * It returns an error message.
    * 
    * @param string message The message you want to display to the user.
    * 
    * @return array The response is being returned as an array.
    */
    public function error_500($message = "Error interno del servidor"){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            'code' => "500",
            'message' => $message
        );
        return json_encode($this->response);
    }


    /**
     * If the user is not logged in, return a 401 error.
     * 
     * @param string message The message you want to display to the user.
     * 
     * @return array The response is being returned as an array.
     */
    public function error_401($message = "No autorizado"){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            'code' => "401",
            'message' => $message
        );
        return json_encode($this->response);
    }
    

}