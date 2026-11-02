<?php

namespace Models;

class AutorRepositorio
{
    private array $autores = [];

    public function __construct()
    {
        $datos = [
            [
                'id' => 1,
                'nombre' => 'Miguel de Cervantes',
                'nacionalidad' => 'Española'
            ],
            [
                'id' => 2,
                'nombre' => 'J.K. Rowling',
                'nacionalidad' => 'Británica'
            ],
            [
                'id' => 3,
                'nombre' => 'Gabriel García Márquez',
                'nacionalidad' => 'Colombiana'
            ]
        ];

        foreach ($datos as $dato) {
            $this->autores[] = new Autor(
                $dato['id'],
                $dato['nombre'],
                $dato['nacionalidad']
            );
        }
    }

    // Obtener todos los autores
    public function getTodos(): array
    {
        return $this->autores;
    }

    // Buscar un autor por ID
    public function getPorId(int $id): ?Autor
    {
        foreach ($this->autores as $autor) {

            if ($autor->getId() === $id) {
                return $autor;
            }
        }

        return null;
    }
}