<?php
require_once 'libs/response.php';


require "app/controllers/controller.php";
require "app/controllers/controllerAuth.php";

require_once "app/middlewares/sessionAuthMiddleware.php";




define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
$res = new Response();



$action = "home";

if (!empty($_GET["action"])) {
    $action = $_GET["action"];
}

$params = explode("/", $action);
$controller = new Controller($res);



switch ($params[0]) {
    case "home":
        sessionAuthMiddleware($res);
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
        if (isset($params[1])) {
            $id_categoria = $params[1];
            $controller->deleteCategoria($id_categoria);
        }
        break;
    case "form_updateCategoria":
        if (isset($params[1])) {
            $id_guitarra = $params[1];
            $controller->showFormUpdateCategoria($id_guitarra);
        }
        break;
    case "updateCategoria":
        if (isset($params[1])) {
            $controller->updateCategoria($params[1]);
           
        }
        break;
    case 'showLogin':
        $controller = new ControllerAuth();
        $controller->showLogin();
        break;
    case 'login':
        $controller=new ControllerAuth();
        $controller->login();
        break;
        
    default:
        echo "404 Page Not Found"; 
        break;
}
