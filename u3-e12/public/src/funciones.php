<?php

function validarObjeto(object $objeto): array
{
    $errores = [];

    $reflection = new ReflectionClass($objeto);

    foreach ($reflection->getProperties() as $propiedad) {

        // Comprobar si la propiedad tiene el atributo Rango
        $atributos = $propiedad->getAttributes(Rango::class);

        if (count($atributos) > 0) {

            // Obtener el atributo
            $rango = $atributos[0]->newInstance();

            // Obtener el valor de la propiedad
            $valor = $propiedad->getValue($objeto);

            // Comprobar el mínimo
            if ($rango->min !== null && $valor < $rango->min) {
                $errores[] = "El valor de {$propiedad->getName()} es inferior al mínimo permitido ({$rango->min}).";
            }

            // Comprobar el máximo
            if ($rango->max !== null && $valor > $rango->max) {
                $errores[] = "El valor de {$propiedad->getName()} supera el máximo permitido ({$rango->max}).";
            }
        }
    }

    return $errores;
}