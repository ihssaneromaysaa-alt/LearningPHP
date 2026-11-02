<?php

class Coche{
    function __construct(
        private string $color = "Rojo",
        private string $marca = "Ferrari",
        private string $modelo = "Aventador",
        private float $velocidad = 300,
        private int $caballos = 500,
        private int $plazas = 2,
    ){}
    public function acelerar(){
        $this->velocidad += 1;
    }public function frenar(){
        $this->velocidad -= 1;
    }
    public function setColor(string $color):void{
        $this->color = $color;
    }public function getColor():string{
        return $this->color;
    }public function getVelocidad():float{
        return $this->velocidad;
    }
    public function toString(): string{
        return "Marca: ".$this->marca."
        <br>Modelo: ".$this->modelo."
        <br>Color: ".$this->color."
        <br>Caballos: ".$this->caballos."
        <br>Velocidad: ".$this->velocidad."
        <br>Plazas: ".$this->plazas."
        ";
    }
}