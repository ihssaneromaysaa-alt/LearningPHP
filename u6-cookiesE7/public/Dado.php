<?php

class Dado{
    private string $ultimaCara = "";
    public function __construct(
        private array $caras = ["AS", "K","Q","J", "roja(ocho)", "negra(siete)"]
    )
    {}
    public function tirar(): void {
        $this->ultimaCara = $this->caras[array_rand($this->caras)]; 
    }
    public function sacarUltimaCara():string{
        return $this->ultimaCara;
    }
}