<?php

namespace Models;

class Autor
{
    private int $id;
    private string $nombre;
    private string $nacionalidad;

    public function __construct(
        int $id,
        string $nombre,
        string $nacionalidad
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getNacionalidad(): string
    {
        return $this->nacionalidad;
    }
}