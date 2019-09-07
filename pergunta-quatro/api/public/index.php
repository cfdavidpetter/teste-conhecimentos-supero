<?php
require "../bootstrap.php";

use Src\Controller\TarefaController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Verifica as ROTAS
// Tudo o resto resulta em um 404
if ($uri[1] !== 'tarefa') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// O ID da entidade é opcional e deve ser um número.
$id = null;
if (isset($uri[2])) {
    $id = (int) $uri[2];
}

$controller = new TarefaController($dbConnection, $_SERVER["REQUEST_METHOD"], $id);
$controller->processRequest();
?>