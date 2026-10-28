<?php
class Producto{
    private string $nombre;
    private float $precio;

    public function getNombre(){
        return $this->nombre;
    }public function getPrecio(){
        return $this->precio;
    }
    public function setNombre(string $nombre){
        $this->nombre=$nombre;
    }public function setPrecio(string $precio){
        $this->precio=$precio;
    }
}

?>