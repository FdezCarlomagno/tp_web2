<?php

class View {
    public function showHome($guitarras, $categorias){
        //Mostrar guitarras sin filtrar
        require "templates/home.phtml";
    }
    public function showGuitarra($guitarra){
        require "templates/guitarra.phtml";
    }
    public function showError($msg){
        require "templates/error.phtml";
    }
}