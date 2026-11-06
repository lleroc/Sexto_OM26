<?php

class Carrera{
    private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function crearTabla(){
        $cadena = "create table if not exist carreras(
        id INT AUTO_INCREMENT PRIMRY KEY, 
        nombre VARCHAR(200) NOT NULL)";

        return $this->conexion->query($cadena);
    }
    public function todos(){
        $cadena = "Select * from carreras";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    public function guardar($nombre){
        $cadena = "insert into carreras(nombre) values(?)";
        $ejecutar = $this->conexion->prepare($cadena);
        $ejecutar->bind_param('s',$nombre);
        return $ejecutar->execute();
    }
}
    