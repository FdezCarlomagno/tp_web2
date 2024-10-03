<?php
require_once 'libs/response.php';


require "app/controllers/controller.php";
require "app/controllers/controllerAuth.php";

require_once "app/middlewares/sessionAuthMiddleware.php";




define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
$res = new Response();



$action = "homeAdmin";

if (!empty($_GET["action"])) {
    $action = $_GET["action"];
}

$params = explode("/", $action);
$controller = new Controller($res);



switch ($params[0]) {
    case "home":
        $controller->showHomeInvitado();
        break;
    case "homeAdmin":
        sessionAuthMiddleware($res);
        $controller->showHome();
        break;
    case "guitarra":

        if (isset($params[1])) {

            $id = $params[1];
            $controller->showGuitarraInvitado($id);
        }
        break;
        case "guitarraAdmin":
            sessionAuthMiddleware($res);
            if (isset($params[1])) {
    
                $id = $params[1];
                $controller->showGuitarra($id);
            }
            break;
        case "guitarra":

            if (isset($params[1])) {
    
                $id = $params[1];
                $controller->showGuitarra($id);
            }
            break;
    case "filtrarAdmin":
        sessionAuthMiddleware($res);

        $controller->showGuitarrasFiltradas();
        break;
    case "filtrar":
        $controller->showGuitarrasFiltradasInvitado();
        break;
    
    case "form_guitarra":
        sessionAuthMiddleware($res);

        $controller->showFormGuitarra();
        break;
    case "addGuitarra":
        sessionAuthMiddleware($res);

        $controller->addGuitarra();
        break;
    case "deleteGuitarra":
        sessionAuthMiddleware($res);

        if (isset($params[1])) {
            $id_guitarra = $params[1];
            $controller->deleteGuitarra($id_guitarra);
        }
        break;
    case "addCategoria":
        sessionAuthMiddleware($res);

        $controller->addCategoria();
        break;
    case "form_categoria":
        sessionAuthMiddleware($res);

        $controller->showFormCategoria();
        break;
    case "deleteCategoria":
        sessionAuthMiddleware($res);

        if (isset($params[1])) {
            $id_categoria = $params[1];
            $controller->deleteCategoria($id_categoria);
        }
        break;
    case "form_updateCategoria":
        sessionAuthMiddleware($res);

        if (isset($params[1])) {
            $id_guitarra = $params[1];
            $controller->showFormUpdateCategoria($id_guitarra);
        }
        break;
    case "updateCategoria":
        sessionAuthMiddleware($res);

        if (isset($params[1])) {
            $controller->updateCategoria($params[1]);
           
        }
        break;
    case 'showlogin':

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
