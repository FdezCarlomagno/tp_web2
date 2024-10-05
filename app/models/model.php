<?php

class Model
{
    private $db;

    public function __construct()
    {
        $this->db = $this->getConnection();
    }
    private function getConnection()
    {
        return new PDO('mysql:host=localhost;dbname=centro_guitarras;charset=utf8', 'root', '');
    }

    public function getGuitarras()
    {
        $query = $this->db->prepare("SELECT * FROM guitarra");
        $query->execute();

        $guitars = $query->fetchAll(PDO::FETCH_OBJ);

        return $guitars;
    }

    public function getGuitarraById($id)
    {
        $query = $this->db->prepare("SELECT * FROM guitarra WHERE id_guitarra = ?");
        $query->execute([$id]);

        $guitar = $query->fetch(PDO::FETCH_OBJ);

        return $guitar;
    }

    public function getGuitarrasByCategoria($id_categoria)
    {
        $query = $this->db->prepare("SELECT * FROM guitarra WHERE categoria_id = ?");
        $query->execute([$id_categoria]);

        $filteredGuitars = $query->fetchAll(PDO::FETCH_OBJ);

        return $filteredGuitars;
    }

    public function addGuitarra($nombre, $categoria_id, $precio, $imagen_url)
    {
        $query = $this->db->prepare("INSERT INTO guitarra(nombre, categoria_id, precio, imagen_url) VALUES(?,?,?,?)");
        $query->execute([$nombre, $categoria_id, $precio, $imagen_url]);

        return $this->db->lastInsertId();
    }

    public function deleteGuitarra($id)
    {
        $query = $this->db->prepare("DELETE FROM guitarra WHERE id_guitarra = ?");
        $query->execute([$id]);
    }

    public function addCategoria($nombre)
    {
        $query = $this->db->prepare("INSERT INTO categoria(nombre) VALUES(?)");
        $query->execute([$nombre]);
    }

    public function getCategoriaById($id_categoria)
    {
        $query = $this->db->prepare("SELECT * FROM categoria WHERE id_categoria = ?");
        $query->execute([$id_categoria]);

        $categoria = $query->fetch(PDO::FETCH_OBJ);

        return $categoria;
    }

    public function getCategoriaByNombre($categoria)
    {
        $query = $this->db->prepare("SELECT * FROM categoria WHERE nombre = ?");
        $query->execute([$categoria]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateCategoriaGuitarra($id_guitarra, $categoria_id)
    {
        $query = $this->db->prepare("UPDATE guitarra SET categoria_id = ?  WHERE id_guitarra = ? ");
        $query->execute([$categoria_id, $id_guitarra]);
    }

    public function deleteCategoria($categoria_id)
    {
        //Que pasa si elimino una categoria y hay guitarras que pertenecen a esa categoria???
        //habria que hacer una categoria "sin categoria" y setear esa guitarra en esa categoria
        //sino va a dar un error porque la categoria no existe

        //entonces primero agarramos todas las guitarras con la categoria que queremos borrar y la seteamos a "sin categoria"

        //en el controlador habria que checkear que el admin no pueda borrar esta categoria, ya que romperia el sistema
        $sin_categoria = $this->getCategoriaByNombre("sin_categoria");
        $id_sin_categoria = $sin_categoria->id_categoria;

        // verifico si la categoría a eliminar es "sin categoría"
        if ($categoria_id == $id_sin_categoria) {
            throw new Exception("No se puede eliminar la categoría 'sin categoría'.");
        }

        $guitars = $this->getGuitarrasByCategoria($categoria_id);

        foreach ($guitars as $guitar) {
            //llamamos a un metodo que hace update a la categoria y le pasamos que actualice la categoria de la guitarra a "sin categoria";
            $this->updateCategoriaGuitarra($guitar->id_guitarra, $id_sin_categoria);
        }
        //ahora borramos la categoria
        $query = $this->db->prepare("DELETE FROM categoria WHERE id_categoria = ?");
        $query->execute([$categoria_id]);
    }
    public function getNombreCategoriaById($id_categoria){
        $query = $this->db->prepare("SELECT nombre FROM categoria WHERE id_categoria = ?");
        $query->execute([$id_categoria]);

        $categoria = $query->fetch(PDO::FETCH_OBJ);

        if($categoria){
            return $categoria->nombre;
        } else {
            return null;
        }
    }
    public function getCategorias(){
        $query = $this->db->prepare("SELECT * FROM categoria");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateImg($id, $imagen_url){
        $query = $this->db->prepare("UPDATE guitarra SET imagen_url = ? WHERE id_guitarra = ?");
        $query->execute([$imagen_url, $id]);

    }
}