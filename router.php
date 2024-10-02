<?php

require "app/controllers/controller.php";


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = "home";

if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "home";
}

$params = explode("/", $action);

$controller = new Controller();

switch ($params[0]) {
    case "home":
        $controller->showHome();
        break;
    case "guitarra":
        if(isset($params[1])){
            $id = $params[1];
            $controller->showGuitarra($id);
        }
        break;
    case "filtrar":
        $controller->showGuitarrasFiltradas();
        break;
    default:
        $controller->showHome();
        break;
}