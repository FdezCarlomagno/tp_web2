<?php

class View {
    private $user=null;
    public function __construct($user)
    {
        $this->user=$user;
        
    }
    public function showHome($guitarras, $categorias){
        //Mostrar guitarras sin filtrar
        require "templates/home.phtml";
    }
    public function showHomeInvitado($guitarras, $categorias){
        //Mostrar guitarras sin filtrar
        require "templates/homeInvitado.phtml";
    }
    public function showGuitarra($guitarra){
        require "templates/guitarraAdmin.phtml";
    }
    public function showGuitarraInvitado($guitarra){
        require "templates/guitarra.phtml";
    }
    public function showError($msg){
        require "templates/error.phtml";
    }
    public function showFormGuitarra($categorias){
        require "templates/formGuitarra.phtml";
    }
    public function showFormCategoria(){
        require "templates/formCategoria.phtml";
    }
    public function showFormUpdateCategoria($guitarra, $categorias){
        require "templates/formUpdateCategoria.phtml";
    }
    public function showFormUpdateImg($guitarra){
        require "templates/formUpdateImg.phtml";
    }
  
    
}