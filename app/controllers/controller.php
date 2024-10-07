<?php

require "app/models/model.php";
require "app/views/view.php";

class Controller
{
    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new Model();
        $this->view = new View($res->user);

    }

    public function showHome()
    {
        $guitarras = $this->model->getGuitarras();
        $categorias = $this->model->getCategorias();

        $this->setCategoriaNombre($guitarras);

        $this->view->showHome($guitarras, $categorias);
    }
    public function showHomeInvitado()
    {
        $guitarras = $this->model->getGuitarras();
        $categorias = $this->model->getCategorias();

        $this->setCategoriaNombre($guitarras);

        $this->view->showHomeInvitado($guitarras, $categorias);

    }
    private function setCategoriaNombre($guitarras)
    {
        foreach ($guitarras as $guitarra) {
            //añadimos dinamicamente un nuevo atributo:
            $guitarra->categoria_nombre = $this->model->getNombreCategoriaById($guitarra->categoria_id);
        }
    }
    public function showGuitarra($id_guitarra)
    {
        $guitarra = $this->model->getGuitarraById($id_guitarra);

        $guitarra->categoria_nombre = $this->model->getNombreCategoriaById($guitarra->categoria_id);

        $this->view->showGuitarra($guitarra);
    }
    public function showGuitarraInvitado($id_guitarra)
    {
        $guitarra = $this->model->getGuitarraById($id_guitarra);

        $guitarra->categoria_nombre = $this->model->getNombreCategoriaById($guitarra->categoria_id);

        $this->view->showGuitarraInvitado($guitarra);
    }
    public function showGuitarrasFiltradas()
    {
        if (isset($_GET['categoria_id']) && !empty($_GET['categoria_id'])) {
            $id_categoria = $_GET['categoria_id'];
            $guitarras = $this->model->getGuitarrasByCategoria($id_categoria);
        } else {
            $this->redirect();
        }

        $categorias = $this->model->getCategorias(); // Obtener todas las categorías

        $this->setCategoriaNombre($guitarras);

        $this->view->showHome($guitarras, $categorias); // Pasar las guitarras y categorías a la vista

    }
    
    public function showGuitarrasFiltradasInvitado()
    {
        if (isset($_GET['categoria_id']) && !empty($_GET['categoria_id'])) {
            $id_categoria = $_GET['categoria_id'];
            $guitarras = $this->model->getGuitarrasByCategoria($id_categoria);
        } else {
            $this->redirect();
        }

        $categorias = $this->model->getCategorias(); // Obtener todas las categorías

        $this->setCategoriaNombre($guitarras);

        $this->view->showHomeInvitado($guitarras, $categorias); // Pasar las guitarras y categorías a la vista

    }
    public function addGuitarra()
    {
        //Validaciones
        if (empty($_POST["nombre"])) {
            $this->view->showError("Falta el nombre de la guitarra");
            return;
        }
        if (empty($_POST["precio"])) {
            $this->view->showError("Falta el precio de la guitarra");
        }
        if (empty($_POST["categoria_id"])) {
            $this->view->showError("Falta la categoria de la guitarra");
        }
        if(empty($_POST["imagen_url"])){
            $this->view->showError("Falta una imagen de la guitarra");
        }

        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $categoria_id = $_POST["categoria_id"];
        $imagen_url = $_POST["imagen_url"];

       

        $this->model->addGuitarra($nombre, $categoria_id, $precio, $imagen_url);

        $this->redirect();
    }
    public function deleteGuitarra($id)
    {   
        $this->model->deleteGuitarra($id);


        

        $this->redirect();
    }
    public function showFormGuitarra()
    {
        $categorias = $this->model->getCategorias();
        $this->view->showFormGuitarra($categorias);
    }
    public function addCategoria()
    {
        if (empty($_POST["nombre"])) {
            $this->view->showError("Falta el nombre de la categoria");
            return;
        }
        $nombre = $_POST["nombre"];

        $this->model->addCategoria($nombre);

        $this->redirect();
    }
    public function showFormCategoria()
    {
        $this->view->showFormCategoria();
    }
    public function deleteCategoria($id_categoria){
        //Implementar un cartel que tenga dos opciones si y no, para que el administrador se de cuenta de que si elimina una categoria, las guitarras que tienen esa categoria van a quedarse sin categoria.
        //$this->view->showAlertMessage();

        //tambien debo fijarme de que no pueda borrar la categoria "sin categoria"

        $categoria = $this->model->getCategoriaByNombre("sin_categoria");

        if($categoria->id_categoria == $id_categoria){
            $this->view->showError("No podes eliminar la categoria 'sin categoria'.");
            return;
        }

        $this->model->deleteCategoria($id_categoria);

        $this->redirect();
    }
    public function showFormUpdateCategoria($id_guitarra){

        $guitarra = $this->model->getGuitarraById($id_guitarra);

        $categorias = $this->model->getCategorias();

        $guitarra->categoria_nombre = $this->model->getNombreCategoriaById($guitarra->categoria_id);

        $this->view->showFormUpdateCategoria($guitarra, $categorias);
    }
    public function updateCategoria($idGuitarra){
        if (isset($_POST["categoria_id"])) {
            $idCategoriaNueva=$_POST["categoria_id"];
            $this->model->updateCategoriaGuitarra($idGuitarra, $idCategoriaNueva);
        }
       
        $this->redirect();



    }
    public function showFormUpdateImg($id){
        $guitarra = $this->model->getGuitarraById($id);

        $guitarra->categoria_nombre = $this->model->getNombreCategoriaById($guitarra->categoria_id);

        $this->view->showFormUpdateImg($guitarra);
    }
    public function showFormUpdateNombre($id)
    {
        $guitarra = $this->model->getGuitarraById($id);

        $guitarra->categoria_nombre = $this->model->getNombreCategoriaById($guitarra->categoria_id);
        $this->view->showFormNombre($guitarra);
        
        

    }
    public function showFormUpdatePrecio($id)
    {
        $guitarra = $this->model->getGuitarraById($id);

        $guitarra->categoria_nombre = $this->model->getNombreCategoriaById($guitarra->categoria_id);
        $this->view->showFormPrecio($guitarra);
        
        

    }
    public function updateNombre($id)
    {
        if(empty($_POST["nombre"])){
            $this->view->showError("ingrese un nombre");
            return;
        }
        $nombre=$_POST["nombre"];
        $this->model->cambiarNombre($id, $nombre);
        header("Location: " . BASE_URL . "/guitarraAdmin/" . $id);


    }
    public function updateImg($id){
        if(empty($_POST["imagen_url"])){
            $this->view->showError("Falta la URL de la imagen");
            return;
        }

        $imagen_url = $_POST["imagen_url"];

        $this->model->updateImg($id, $imagen_url);

        header("Location: " . BASE_URL . "/guitarraAdmin/" . $id);
    }
    public function updatePrecio($id){
        if(empty($_POST["precio"])){
            $this->view->showError("Falta el precio");
            return;
        }

        $precio = $_POST["precio"];

        $this->model->updatePrecio($id, $precio);

        header("Location: " . BASE_URL . "/guitarraAdmin/" . $id);
    }
    public function showError($msg){
        $this->view->showError($msg);
    }

    private function redirect()
    {
        return header("Location: " . BASE_URL);
    }
}