<?php
// App/Modelos/Usuario.php

namespace App\Modelos;

class Usuario
{
    private string $nombre;
    private string $email;

    public function __construct(string $nombre, string $email)
    {
        $this->nombre = $nombre;
        $this->email  = $email;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function mostrarInfo(): void
    {
        echo "Usuario: {$this->nombre} | Email: {$this->email}<br>";
    }
}