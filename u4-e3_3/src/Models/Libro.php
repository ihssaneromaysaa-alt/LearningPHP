<?php

namespace Models;

class Libro
{
    private int $id;
    private string $titulo;
    private int $anio;
    private int $autorId;
    private bool $disponible;

    public function __construct(
        int $id,
        string $titulo,
        int $anio,
        int $autorId,
        bool $disponible
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->anio = $anio;
        $this->autorId = $autorId;
        $this->disponible = $disponible;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getAnio(): int
    {
        return $this->anio;
    }

    public function getAutorId(): int
    {
        return $this->autorId;
    }

    public function getDisponible(): bool
    {
        return $this->disponible;
    }
}