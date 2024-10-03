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
        if (isset($params[1])) {
            $id = $params[1];
            $controller->showGuitarra($id);
        }
        break;
    case "filtrar":
        $controller->showGuitarrasFiltradas();
        break;
    case "form_guitarra":
        $controller->showFormGuitarra();
        break;
    case "addGuitarra":
        $controller->addGuitarra();
        break;
    case "deleteGuitarra":
        if (isset($params[1])) {
            $id_guitarra = $params[1];
            $controller->deleteGuitarra($id_guitarra);
        }
        break;
    case "addCategoria":
        $controller->addCategoria();
        break;
    case "form_categoria":
        $controller->showFormCategoria();
        break;
    case "deleteCategoria":
        if(isset($params[1])){
            $id_categoria = $params[1];
            $controller->deleteCategoria($id_categoria);
        }
        break;
    case "form_updateCategoria":
        if(isset($params[1])){
            $id_guitarra = $params[1];
            $controller->showFormUpdateCategoria($id_guitarra);
        }
        break;
    case "updateCategoria":
        if(isset($params[1])){
            //falta implementar esto
        }
    default:
        $controller->showHome();
        break;
}