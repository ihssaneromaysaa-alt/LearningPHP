<?php
declare(strict_types=1);

namespace Models;

// contiene los artículos de ejemplo y permite buscarlos por identificador
class Articulo
{
    private array $articulos = [
        99 => [
            'id' => 99,
            'nombre' => 'Auriculares inalámbricos',
            'descripcion' => 'Auriculares bluetooth con estuche de carga.',
            'precio' => 29.95
        ],
        100 => [
            'id' => 100,
            'nombre' => 'Teclado mecánico',
            'descripcion' => 'Teclado mecánico con conexión USB.',
            'precio' => 54.50
        ],
        101 => [
            'id' => 101,
            'nombre' => 'Ratón óptico',
            'descripcion' => 'Ratón óptico con conexión inalámbrica.',
            'precio' => 18.75
        ]
    ];

    // devuelve los datos del artículo o null si no está registrado
    public function buscarPorId(int $id): ?array
    {
        return $this->articulos[$id] ?? null;
    }
}
