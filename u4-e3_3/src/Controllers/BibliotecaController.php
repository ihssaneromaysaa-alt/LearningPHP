<?php

namespace Controllers;

use Models\AutorRepositorio;
use Models\LibroRepositorio;

class BibliotecaController
{
    private AutorRepositorio $autorRepositorio;
    private LibroRepositorio $libroRepositorio;

    public function __construct()
    {
        $this->autorRepositorio = new AutorRepositorio();
        $this->libroRepositorio = new LibroRepositorio();
    }

    // Página principal
    public function inicio(): void
    {
        require VIEWS_PATH . '/biblioteca/inicio.php';
    }

    // Lista de libros con su autor
    public function libros(): void
    {
        $libros = $this->libroRepositorio->getTodos();

        $autorRepositorio = $this->autorRepositorio;

        require VIEWS_PATH . '/biblioteca/libros.php';
    }

    // Detalle de un libro
    public function libro(int $id): void
    {
        $libro = $this->libroRepositorio->getPorId($id);

        $autor = null;

        if ($libro !== null) {
            $autor = $this->autorRepositorio->getPorId(
                $libro->getAutorId()
            );
        }

        require VIEWS_PATH . '/biblioteca/detalleLibro.php';
    }

    // Ficha de un autor con todos sus libros
    public function autor(int $id): void
    {
        $autor = $this->autorRepositorio->getPorId($id);

        $libros = [];

        if ($autor !== null) {
            $libros = $this->libroRepositorio->getPorAutor($id);
        }

        require VIEWS_PATH . '/biblioteca/detalleAutor.php';
    }

    // Listado de libros disponibles
    public function disponibles(): void
    {
        $libros = $this->libroRepositorio->getDisponibles();

        $autorRepositorio = $this->autorRepositorio;

        require VIEWS_PATH . '/biblioteca/disponibles.php';
    }
}