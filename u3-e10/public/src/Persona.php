<?php
class Persona{
    function __construct( private string $nombre,
                         private int $edad,
                         private string $ciudad){
    }
    public function __call(string $name, array $arguments): mixed {
        if (str_starts_with($name, 'get')) {
            $propiedad = lcfirst(substr($name, 3));
            if (property_exists($this, $propiedad)) {
                return $this->$propiedad;
            }
        }

        if (str_starts_with($name, 'set')) {
            $propiedad = lcfirst(substr($name, 3));
            // lcfirst es para poner la primera letra en minúscula.
            if (property_exists($this, $propiedad) && count($arguments) > 0) {
                $this->$propiedad = $arguments[0];
                return null;
            }
        }

        throw new BadMethodCallException("El método '$name' no existe.");
    }

}
