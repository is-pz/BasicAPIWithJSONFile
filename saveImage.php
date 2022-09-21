<?php


class SaveImage {

    private $img;
    private $error;

    /**
     * Get the value of img
     */ 
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get the value of error
     */ 
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set the value of error
     *
     * @return  self
     */ 
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    function saveImage($file){
        $directory = "img/";

        $this->setImg(basename($file["name"]));
        $img = $directory . basename($file["name"]);

        $typeFile = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    
        $checarSiimg = getimagesize($file["tmp_name"]);
        
        // valida que es img
        if($checarSiimg != false){
            
            $size = $file["size"];
            
            //validando tamaño del archivo
            if($size > 500000){
                $this->setError("El archivo tiene que ser menor a 500kb");
                return false;
            }

            //Valida el tipo de imagen
            if($typeFile != "jpg" || $typeFile != "jpeg"){    
                $this->setError("Solo se admiten archivos jpg/jpeg");
                return false;
            }

            //Valida si existe un error al subir la imagen
            if(!move_uploaded_file($file["tmp_name"], $img)){
                $this->setError("Hubo un error en la subida del archivo");
                return false;
            }

            //"El archivo se subió correctamente";
            return true;
            
        }else{
            $this->setError("El archivo no es una imagen");
            return false;
        }
    }

}