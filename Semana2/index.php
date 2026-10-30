<?php

require_once __DIR__ . 'semana2/config/database.php';
require_once __DIR__ . 'controllers/PersonasControllers.php';

$controlleor = new PersonaController($conexion);

if($_SERVER['REQUEST_METHOS'] == 'POST'){
    $controlleoR->guardar();

}else{
    $controlleor->index();
}