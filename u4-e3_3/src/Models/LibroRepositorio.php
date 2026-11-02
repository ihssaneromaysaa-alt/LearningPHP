<?php

namespace Models;

class LibroRepositorio
{
    private array $libros = [];

    public function __construct()
    {
        $datos = [
            [
                'id' => 1,
                'titulo' => 'Don Quijote de la Mancha',
                'anio' => 1605,
                'autorId' => 1,
                'disponible' => true
            ],
            [
                'id' => 2,
                'titulo' => 'La Galatea',
                'anio' => 1585,
                'autorId' => 1,
                'disponible' => false
            ],
            [
                'id' => 3,
                'titulo' => 'Novelas ejemplares',
                'anio' => 1613,
                'autorId' => 1,
                'disponible' => true
            ],
            [
                'id' => 4,
                'titulo' => 'Harry Potter y la piedra filosofal',
                'anio' => 1997,
                'autorId' => 2,
                'disponible' => true
            ],
            [
                'id' => 5,
                'titulo' => 'Harry Potter y la cámara secreta',
                'anio' => 1998,
                'autorId' => 2,
                'disponible' => false
            ],
            [
                'id' => 6,
                'titulo' => 'Cien años de soledad',
                'anio' => 1967,
                'autorId' => 3,
                'disponible' => true
            ],
            [
                'id' => 7,
                'titulo' => 'El amor en los tiempos del cólera',
                'anio' => 1985,
                'autorId' => 3,
                'disponible' => false
            ],
            [
                'id' => 8,
                'titulo' => 'Crónica de una muerte anunciada',
                'anio' => 1981,
                'autorId' => 3,
                'disponible' => true
            ]
        ];

        foreach ($datos as $dato) {
            $this->libros[] = new Libro(
                $dato['id'],
                $dato['titulo'],
                $dato['anio'],
                $dato['autorId'],
                $dato['disponible']
            );
        }
    }

    // Obtener todos los libros
    public function getTodos(): array
    {
        return $this->libros;
    }

    // Buscar un libro por ID
    public function getPorId(int $id): ?Libro
    {
        foreach ($this->libros as $libro) {

            if ($libro->getId() === $id) {
                return $libro;
            }
        }

        return null;
    }

    // Obtener los libros de un autor
    public function getPorAutor(int $autorId): array
    {
        $resultado = [];

        foreach ($this->libros as $libro) {

            if ($libro->getAutorId() === $autorId) {
                $resultado[] = $libro;
            }
        }

        return $resultado;
    }

    // Obtener solamente los libros disponibles
    public function getDisponibles(): array
    {
        $resultado = [];

        foreach ($this->libros as $libro) {

            if ($libro->getDisponible()) {
                $resultado[] = $libro;
            }
        }

        return $resultado;
    }
}