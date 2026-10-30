<?php

class Persona{
    public function __construct(private mysqli $conexion){}

    public function guardar($nombre):bool{
        $ejecutar = $this->conexion->prepare('insert into personas(nombre) values(?)');
        $ejecutar->bind_param('s',$nombre);
        return $ejecutar->execute();
    }
    public function listar():mysql_result|bool{
        return $this->conexion->query('select id, nombre from personas');
    }
}