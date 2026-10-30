<?php

require_once __DIR__ . '/../models/Persona.php';

class PersonaController{
    private Persona $modelos;

    public function __construct(mysqli $conexion){
        $this->modelos = new Persona($conexion);
    }

    public function index():void{
        $personas = $this->modelos->listar();
        require __DIR__ . '../../views/personas.php';
    }

    public function guardar():void{
        $nombre = trim($_POST['nombre'] ?? '');
        if($nombre !== ''){
            $this->modelos->guardar($nombre);
        }
        header('Location: index.php');
        exit;
    }
}