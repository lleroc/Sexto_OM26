<?php

class Database{
    private $conexion;
    
    public function conectar(){
        $this->conexion = new mysqli("localhost",'root','root','sexto');
        if($this->conexion->connect_error){
            die("Error al conectar con el servidor");
        }
        return $this->conexion;
    }
}