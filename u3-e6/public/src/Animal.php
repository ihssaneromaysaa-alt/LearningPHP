<?php
// src/Animal.php

class Animal
{
    // Propiedades protegidas (accesibles por las clases hijas)
    protected float $tamano;
    protected string $raza;
    protected string $color;
    protected string $nombre;
    protected string $ultimoError = '';

    public function __construct(
        float $tamano,
        string $raza,
        string $color,
        string $nombre
    ) {
        // Intentamos asignar todo. Si algo falla, guardamos el error.
        if (!$this->set_tamano($tamano) ||
            !$this->set_raza($raza) ||
            !$this->set_color($color) ||
            !$this->set_nombre($nombre)
        ) {
            echo "Error al crear el animal: " . $this->ultimoError . "<br>";
        }
    }

    // ========== GETTERS ==========
    public function get_tamano(): float { return $this->tamano; }
    public function get_raza(): string  { return $this->raza; }
    public function get_color(): string { return $this->color; }
    public function get_nombre(): string { return $this->nombre; }
    public function get_ultimo_error(): string { return $this->ultimoError; }

    // ========== SETTERS (con validación) ==========
    public function set_nombre(string $nombre): bool
    {
        $nombre = trim($nombre);

        if ($nombre === '') {
            $this->ultimoError = "El nombre no puede estar vacío.";
            return false;
        }
        if (strlen($nombre) > 21) {
            $this->ultimoError = "El nombre no puede tener más de 21 caracteres.";
            return false;
        }

        $this->nombre = $nombre;
        $this->ultimoError = '';
        return true;
    }

    public function set_raza(string $raza): bool
    {
        $raza = trim($raza);
        if ($raza === '' || strlen($raza) > 30) {
            $this->ultimoError = "La raza debe tener entre 1 y 30 caracteres.";
            return false;
        }
        $this->raza = $raza;
        $this->ultimoError = '';
        return true;
    }

    public function set_color(string $color): bool
    {
        $color = trim($color);
        if ($color === '' || strlen($color) > 20) {
            $this->ultimoError = "El color debe tener entre 1 y 20 caracteres.";
            return false;
        }
        $this->color = $color;
        $this->ultimoError = '';
        return true;
    }

    public function set_tamano(float $tamano): bool
    {
        // Validación genérica (las clases hijas pueden sobreescribirla)
        if ($tamano <= 0 || $tamano > 100) {
            $this->ultimoError = "El tamaño debe estar entre 0.1 y 100.";
            return false;
        }
        $this->tamano = $tamano;
        $this->ultimoError = '';
        return true;
    }

    // Método genérico que las hijas pueden sobreescribir
    public function mostrar_propiedades(): void
    {
        echo $this->nombre . " es de raza " . $this->raza
           . ", mide " . $this->tamano
           . " y es de color " . $this->color;
    }

    // Método genérico que las hijas DEBEN sobreescribir
    public function speak(): string
    {
        return $this->nombre . ": ...";
    }
}