<?php

header("Content-Type: application/json");

require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/models/carrera.php";
require_once __DIR__ . "/controllers/CarreraController.php";

try {
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
            $nombre = $_POST["nombre"] ?? "";
            $nombre = is_string($nombre) ? trim($nombre) : "";

            if ($nombre != '' && mb_strlen($nombre) <= 200){
                http_response_code(201);
                $controlador->guardar($nombre);
            }else{
                http_response_code(400);
                echo json_encode(["error"=> "El nombre es requerido y debe tener máximo 200 caracteres"]);
            }
        }else{
            http_response_code(405);
            echo json_encode(["error"=> "El metodo no es permitido"]);
        }
        break;
    case "creartabla":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controlador->creartabla();
        } else {
            http_response_code(405);
            echo json_encode(["error" => "El metodo no es permitido"]);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["error"=> "Accion no encontrada"]);
}


} catch (mysqli_sql_exception $error) {
    http_response_code(500);
    error_log($error->getMessage());
    $mensaje = $error->getCode() == 1146
        ? "La tabla carreras no existe. Pulsa Crear tabla para comenzar."
        : "No se pudo completar la operación en la base de datos.";
    echo json_encode(["error" => $mensaje]);
} catch (RuntimeException $error) {
    http_response_code(500);
    error_log($error->getMessage());
    echo json_encode(["error" => "No se pudo conectar con la base de datos."]);
}
