<?php
declare(strict_types=1);

namespace Models;

class Candidato
{
    // listas autorizadas: todo lo que no este aqui se rechaza
    public const SITUACIONES = [
        'sin_empleo' => 'Sin empleo',
        'media_jornada' => 'Media jornada',
        'tiempo_completo' => 'Tiempo completo',
    ];

    public const LENGUAJES = ['Python', 'PHP', 'JavaScript', 'Java', 'C++'];

    // recibe $_POST, sanea y valida. devuelve [datos, errores]
    public static function procesar(array $post): array
    {
        $errores = [];

        $nombre = self::texto($post['nombre'] ?? null);
        $apellidos = self::texto($post['apellidos'] ?? null);
        $correo = self::saneaCorreo($post['correo'] ?? null);
        $telefono = self::texto($post['telefono'] ?? null);
        $situacion = is_string($post['situacion'] ?? null) ? trim($post['situacion']) : '';
        $url = self::saneaUrl($post['url'] ?? null);

        // nombre y apellidos
        $patronNombre = '/^\p{L}[\p{L} \'’-]{1,49}$/u';

        if ($nombre === '') {
            $errores['nombre'] = 'El nombre es obligatorio.';
        } elseif (!preg_match($patronNombre, $nombre)) {
            $errores['nombre'] = 'El nombre solo admite letras, espacios, guiones y apóstrofos (2 a 50 caracteres).';
        }

        if ($apellidos === '') {
            $errores['apellidos'] = 'Los apellidos son obligatorios.';
        } elseif (!preg_match($patronNombre, $apellidos)) {
            $errores['apellidos'] = 'Los apellidos solo admiten letras, espacios, guiones y apóstrofos (2 a 50 caracteres).';
        }

        // correo
        if ($correo === '') {
            $errores['correo'] = 'El correo es obligatorio.';
        } elseif (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
            $errores['correo'] = 'El correo no tiene un formato válido.';
        }

        // telefono
        if ($telefono === '') {
            $errores['telefono'] = 'El teléfono es obligatorio.';
        } elseif (!preg_match('/^\d{9}$/', $telefono)) {
            $errores['telefono'] = 'El teléfono debe tener exactamente 9 dígitos.';
        }

        // situacion laboral: debe ser una de las claves permitidas
        if ($situacion === '') {
            $errores['situacion'] = 'Selecciona tu situación laboral.';
        } elseif (!array_key_exists($situacion, self::SITUACIONES)) {
            $errores['situacion'] = 'La situación laboral enviada no está permitida.';
        }

        // lenguajes: debe ser un array y cada valor estar en la lista autorizada
        $lenguajes = [];
        $recibidos = $post['lenguajes'] ?? [];

        if (!is_array($recibidos)) {
            $errores['lenguajes'] = 'El formato de los lenguajes no es válido.';
        } else {
            $invalidos = [];

            foreach ($recibidos as $lenguaje) {
                if (is_string($lenguaje) && in_array($lenguaje, self::LENGUAJES, true)) {
                    $lenguajes[] = $lenguaje;
                } else {
                    $invalidos[] = is_string($lenguaje) ? $lenguaje : '(valor no válido)';
                }
            }

            $lenguajes = array_values(array_unique($lenguajes));

            if ($invalidos) {
                $errores['lenguajes'] = 'Lenguajes no permitidos: ' . implode(', ', $invalidos) . '.';
            } elseif (!$lenguajes) {
                $errores['lenguajes'] = 'Selecciona al menos un lenguaje.';
            }
        }

        // url
        if ($url === '') {
            $errores['url'] = 'La URL es obligatoria.';
        } elseif (filter_var($url, FILTER_VALIDATE_URL) === false
            || !in_array(strtolower((string) parse_url($url, PHP_URL_SCHEME)), ['http', 'https'], true)) {
            $errores['url'] = 'La URL no es válida (debe empezar por http:// o https://).';
        }

        $datos = [
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'correo' => $correo,
            'telefono' => $telefono,
            'situacion' => $situacion,
            'lenguajes' => $lenguajes,
            'url' => $url,
        ];

        return [$datos, $errores];
    }

    // texto: solo string, sin etiquetas, espacios normalizados
    private static function texto(mixed $valor): string
    {
        if (!is_string($valor)) {
            return '';
        }
        return trim(preg_replace('/\s+/', ' ', strip_tags($valor)) ?? '');
    }

    private static function saneaCorreo(mixed $valor): string
    {
        return is_string($valor) ? (string) filter_var(trim($valor), FILTER_SANITIZE_EMAIL) : '';
    }

    private static function saneaUrl(mixed $valor): string
    {
        return is_string($valor) ? (string) filter_var(trim($valor), FILTER_SANITIZE_URL) : '';
    }
}