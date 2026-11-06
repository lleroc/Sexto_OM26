<?php

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/PersonasControllers.php';

$controlleor = new PersonaController($conexion);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $controlleor->guardar();

}else{
    $controlleor->index();
}