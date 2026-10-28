<?php
require_once __DIR__ . "/Identificable.php";
class Producto {
    use Identificable;
    private string $id;
    function __construct(){
        $this->id = $this->getId();
    }
    function getPrefijoId(): string{
        return "PRD";
    }
}