<?php
function obtenerFechaCastellano(): string
{
    date_default_timezone_set('Europe/Madrid');
    $dias  = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    $meses = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];
    $diaSemana = $dias[(int)date('w')];
    $dia       = date('j');          
    $mes       = $meses[(int)date('n') - 1]; 
    $anio      = date('Y');

    return "$diaSemana, $dia de $mes de $anio";
}
?>