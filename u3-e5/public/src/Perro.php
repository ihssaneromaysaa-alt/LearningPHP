<?php

class Perro
{
    // Propiedades privadas
    private float $tamano;
    private string $raza;
    private string $color;
    private string $nombre;

    // Mensaje del último error (opcional pero muy útil)
    private string $ultimoError = '';

    public function __construct(
        float $tamano,
        string $raza,
        string $color,
        string $nombre
    ) {
        // Validamos todo al crear el objeto
        if (!$this->set_tamano($tamano) ||
            !$this->set_raza($raza) ||
            !$this->set_color($color) ||
            !$this->set_nombre($nombre)
        ) {
            // Si algo falla, puedes lanzar una excepción o dejar el objeto a medias.
            // Aquí simplemente mostramos el error.
            echo "Error al crear el perro: " . $this->ultimoError . "<br>";
        }
    }

    // ========== GETTERS ==========
    public function get_tamano(): float
    {
        return $this->tamano;
    }

    public function get_raza(): string
    {
        return $this->raza;
    }

    public function get_color(): string
    {
        return $this->color;
    }

    public function get_nombre(): string
    {
        return $this->nombre;
    }

    // ========== SETTERS (devuelven true/false) ==========

    public function set_nombre(string $nombre): bool
    {
        // Validaciones
        if (!is_string($nombre)) {
            $this->ultimoError = "El nombre debe ser una cadena de texto.";
            return false;
        }

        $nombre = trim($nombre);

        if ($nombre === '') {
            $this->ultimoError = "El nombre no puede estar vacío.";
            return false;
        }

        if (strlen($nombre) > 21) {
            $this->ultimoError = "El nombre no puede tener más de 21 caracteres.";
            return false;
        }

        // Si llega aquí → todo correcto
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
        if ($tamano <= 0 || $tamano > 100) {
            $this->ultimoError = "El tamaño debe ser un número entre 0.1 y 100.";
            return false;
        }

        $this->tamano = $tamano;
        $this->ultimoError = '';
        return true;
    }

    // Método extra útil
    public function get_ultimo_error(): string
    {
        return $this->ultimoError;
    }

    // Método para mostrar las propiedades
    public function mostrar_propiedades(): void
    {
        echo $this->nombre . " es de raza " . $this->raza
           . ", su tamaño es de " . $this->tamano
           . " y es de color " . $this->color;
    }

    public function speak(): string
    {
        return $this->nombre . ": guau";
    }
}