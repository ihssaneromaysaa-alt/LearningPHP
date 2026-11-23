<?php
declare(strict_types=1);

namespace Models;

class Usuario
{
    private string $id;
    private string $usuario;
    private string $email;
    private string $hash;

    public function __construct(string $usuario,string $email, string $password)
    {
        $this->id = uniqid('user_', true);
        $this->usuario = $usuario;
        $this->email = $email;
        // las contraseñas solo se almacenan en password hash
        $this->hash = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function comprobar(string $usuario, string $password): bool
    {
        // verificar que el usuario coincide
        if (!hash_equals($this->usuario, $usuario))
            return false;

        // leer el archivo json con file_exists y is_readable
        $ruta = RUTA_USUARIOS;
        if (!file_exists($ruta) || !is_readable($ruta))
            throw new \RuntimeException("No se pudo acceder al archivo de usuarios.");

        $json = file_get_contents($ruta);
        if ($json === false)
            throw new \RuntimeException("Error al leer el archivo de usuarios.");

        $datos = json_decode($json, true);
        if (!isset($datos['usuarios'][$usuario]))
            return false; // usuario no existe

        // obtener el hash almacenado
        $hashAlmacenado = $datos['usuarios'][$usuario];
        
        // verificar la contraseña
        return password_verify($password, $hashAlmacenado);
    }
    public static function registrar(string $usuario, string $email, string $password): bool{
        // validar que el usuario y la contraseña no estén vacíos
        if (empty($usuario) || empty($password) || empty($email))
            return false;

        // definir la ruta de la carpeta y el archivo
        $rutaCarpeta = RUTA_CARPETA;
        $rutaArchivo = RUTA_USUARIOS;

        // Crear la carpeta si no existe
        if (!file_exists($rutaCarpeta)) {
            if (!mkdir($rutaCarpeta, 0755, true)) {
                throw new \RuntimeException("No se pudo crear la carpeta de datos.");
            }
        }

        // Crear el archivo JSON con estructura inicial si no existe
        if (!file_exists($rutaArchivo)) {
            $datosIniciales = ['usuarios' => []];
            $jsonInicial = json_encode($datosIniciales, JSON_PRETTY_PRINT);
            if ($jsonInicial === false) {
                throw new \RuntimeException("Error al codificar los datos iniciales a JSON.");
            }
            if (file_put_contents($rutaArchivo, $jsonInicial) === false) {
                throw new \RuntimeException("Error al crear el archivo de usuarios.");
            }
        }

        // Leer el archivo JSON existente
        $json = file_get_contents($rutaArchivo);
        if ($json === false) {
            throw new \RuntimeException("Error al leer el archivo de usuarios.");
        }
        $datos = json_decode($json, true);
        if (!is_array($datos)) {
            throw new \RuntimeException("El archivo JSON no tiene la estructura esperada.");
        }

        // Verificar si el usuario ya existe
        if (isset($datos['usuarios'][$usuario])) {
            return false; // Usuario ya existe
        }

        // Crear un nuevo usuario y obtener su hash
        $nuevoUsuario = new self($usuario, $email, $password);
        $datos['usuarios'][$usuario] = $nuevoUsuario->getHash();

        // Guardar los datos actualizados en el archivo JSON
        $jsonActualizado = json_encode($datos, JSON_PRETTY_PRINT);
        if ($jsonActualizado === false) {
            throw new \RuntimeException("Error al codificar los datos a JSON.");
        }

        $resultado = file_put_contents($rutaArchivo, $jsonActualizado);
        if ($resultado === false) {
            throw new \RuntimeException("Error al guardar el archivo de usuarios.");
        }

        return true;
    }
}
