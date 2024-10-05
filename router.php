<?php
require_once 'libs/response.php';


require "app/controllers/controller.php";
require "app/controllers/controllerAuth.php";

require_once "app/middlewares/sessionAuthMiddleware.php";




define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');




$action = "homeAdmin";

if (!empty($_GET["action"])) {
    $action = $_GET["action"];
}

$params = explode("/", $action);

//INSTANCIACION DE OBJETOS A UTILIZAR
$res = new Response();
$controller = new Controller($res);
$controllerAuth = new ControllerAuth();

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
    case "form_updateImg":
        if (isset($params[1])) {
            $controller->showFormUpdateImg($params[1]);
        }

        break;
    case "updateImg":
        sessionAuthMiddleware($res);

        if (isset($params[1])) {
            $controller->updateImg($params[1]);
        }
        break;
    case "signup":
        $controllerAuth->showSignup();
        break;
    case "error":
        $controllerAuth->showError();
        break;
    case 'showlogin':
        $controllerAuth->showLogin();
        break;
    case 'login':
        $controllerAuth->login();
        break;
    case 'logout':
        $controllerAuth->logout();
    default:
        $controller->showError("Pagina no encontrada");
        break;
}
