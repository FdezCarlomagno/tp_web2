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
    private function redirect()
    {
        return header("Location: " . BASE_URL);
    }
}