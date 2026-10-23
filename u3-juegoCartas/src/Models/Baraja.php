<?php
declare(strict_types=1);

namespace Models;

use Enums\Palo;
use Enums\Valor;
use InvalidArgumentException;

class Baraja{
    private array $cartas=[];
    function __construct()
    {
        $this->crearBarajaCompleta();
    }
    function crearBarajaCompleta(): void
    {
        $this->cartas = [];

        foreach (Palo::cases() as $palo) {
            foreach (Valor::cases() as $valor) {
                $this->cartas[] = new Carta($valor, $palo);
            }
        }
    }

    /**
     * cartas el mazo (modifica el array por referencia)
     * 
     */
    function barajarCartas(): void
    {
        shuffle($this->cartas);
    }

    /**
     * Saca la última carta del mazo
     *
     * @return Carta|null
     */
    function sacarCarta(): ?Carta
    {
        return array_pop($this->cartas);
    }

    /**
     * Muestra la carta como imagen HTML
     */
    public function mostrarCarta(Carta $carta): void
    {
        $img = $carta->getImagen();   // genera: bastos_3.jpg
        $alt = $carta->toString();

        // Ruta correcta (igual que la que te funciona)
        echo "<img src='assets/img/{$img}' alt='{$alt}' width='100' style='margin:4px;'>";
    }
    public function getCartas(): array
    {
        return $this->cartas;
    }
}