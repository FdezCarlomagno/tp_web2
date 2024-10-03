<?php

class UserModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=centro_guitarras;charset=utf8', 'root', '');
    }
 
    public function getUserByNickName($nickname) {    
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nickname = ?");
        $query->execute([$nickname]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }
}