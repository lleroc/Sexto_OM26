<?php

header("Content-Type: application/json");

require_once "config/database.php";
require_once "models/carrera.php";
require_once "controllers/CarreraController.php";

$db = new Database();
$conexion = $db->conectar();

$controlador = new CarreraController($conexion);

$accion = $_GET["accion"] ?? 'todos';

switch ($accion){
    case "todos":
        $controlador->todos();
        break;
    case "guardar":
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $nombre = trim($_POST["nombre"] ?? "");

            if ($nombre != ''){
                http_response_code(201);
                $controlador->guardar($nombre);
            }else{
                http_response_code(400);
                echo json_encode(["error"=> "Nombres es requerido"]);
            }
        }else{
            http_response_code(405);
            echo json_encode(["error"=> "El metodo no es permitido"]);
        }
        break;
    case "creartabla":
        $controlador->creartabla();
        break;

    defult:
        http_response_code(404);
        echo json_encode(["error"=> "Accion no encontrada"]);
}

