
<?php

class PerfilJugador
{
    // Propiedades
    private string $nombre;
    private int $puntuacionMaxima;
    private array $_logTemporal = [];

    // Constructor
    public function __construct(string $nombre, int $puntuacionMaxima)
    {
        $this->nombre = $nombre;
        $this->puntuacionMaxima = $puntuacionMaxima;
        $this->_logTemporal = [];
    }

    // Añadir un mensaje al log
    public function agregarLog(string $mensaje): void
    {
        $this->_logTemporal[] = $mensaje;
    }

    // Obtener todos los logs
    public function getLog(): array
    {
        return $this->_logTemporal;
    }

    // Serializar únicamente los datos que queremos guardar
    public function __serialize(): array
    {
        return [
            'nombre' => $this->nombre,
            'puntuacionMaxima' => $this->puntuacionMaxima
        ];
    }

    // Restaurar los datos del objeto
    public function __unserialize(array $datos): void
    {
        $this->nombre = $datos['nombre'];
        $this->puntuacionMaxima = $datos['puntuacionMaxima'];

        // Reiniciar el log temporal
        $this->_logTemporal = [];
    }
}
