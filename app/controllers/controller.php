<?php

require "app/models/model.php";
require "app/views/view.php";

class Controller
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

    public function showHome()
    {
        $guitarras = $this->model->getGuitarras();
        $categorias = $this->model->getCategorias();

        $this->setCategoriaNombre($guitarras);

        $this->view->showHome($guitarras, $categorias);
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

        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $categoria_id = $_POST["categoria_id"];

        $this->model->addGuitarra($nombre, $categoria_id, $precio);

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

    private function redirect()
    {
        return header("Location: " . BASE_URL);
    }
}