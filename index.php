<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controller\FrutaController;

$frutaController = new FrutaController();

$method = $_SERVER['REQUEST_METHOD'];

$path = $_GET['path'] ?? '';

if ($path !== 'frutas') {
    http_response_code(404);
    echo json_encode(["message" => "Rota nao encontrada"]);
    exit;
}

switch ($method) {
    case 'GET':
        $frutaController->getFrutas();
        break;

    case 'POST':
        $frutaController->createFruta();
        break;

    case 'PUT':
        $frutaController->updateFruta();
        break;

    case 'DELETE':
        $frutaController->deleteFruta();
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Metodo nao permitido"]);
        break;
}
