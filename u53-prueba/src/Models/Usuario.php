<?php
declare(strict_types=1);

namespace Models;

// simula la base de datos con un unico usuario ficticio
class Usuario
{
    private string $usuario;
    private string $hash;
    private string $foto = '';

    public function __construct(string $usuario, string $password, string $foto='')
    {
        $this->usuario = $usuario;
        // la clave nunca se guarda en texto plano, solo su hash
        $this->hash = password_hash($password, PASSWORD_BCRYPT);
        $this->foto = $foto;
    }

    // comprueba el usuario y la contraseña recibidos
    public function comprobar(string $usuario, string $password): bool
    {
        return hash_equals($this->usuario, $usuario)
            && password_verify($password, $this->hash);
    }
    public function setFoto(string $foto){
        $this->foto = $foto;
    }
    public function getUsuario(): string{
        return $this->usuario;
    }
    public static function fromArray(array $datos): self{
        
        $usuario = new Usuario(
            trim($datos['usuario']??''),
            trim($datos['hash']??''),
            trim($datos['foto']??''),
        );
        return $usuario;
    }
}
