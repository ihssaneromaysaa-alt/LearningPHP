<?php
declare(strict_types=1);

namespace Models;

// simula la base de datos con un unico usuario ficticio
class Usuario
{
    private string $usuario;
    private string $hash;

    public function __construct(string $usuario, string $password)
    {
        $this->usuario = $usuario;
        // la clave nunca se guarda en texto plano, solo su hash
        $this->hash = password_hash($password, PASSWORD_BCRYPT);
    }

    // comprueba el usuario y la contraseña recibidos
    public function comprobar(string $usuario, string $password): bool
    {
        return hash_equals($this->usuario, $usuario)
            && password_verify($password, $this->hash);
    }
    public static function fromArray(array $datos): self{
        return new self(
            trim($datos['usuario']??''),
            trim($datos['password']??''),
        );
    }
}