<?php

class CarreraController{
    private $carreraModel;
    public function __construct($conexion) {
        $this->carreraModel = new Carrera($conexion);
    }

    public function todos(){
        $datos = $this->carreraModel->todos();
        echo json_encode($datos);
    }

    public function guardar($nombre){
        $resultado = $this->carreraModel->guardar($nombre);

        echo json_encode([
            "guardado" => $resultado
        ]);
    }

    public function creartabla(){
        $resultado = $this->carreraModel->creartabla();
        echo json_encode([
            "tabla_creada" => $resultado
        ]);
    }
}