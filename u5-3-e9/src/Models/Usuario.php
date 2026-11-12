<?php
namespace Models;
class Usuario{
    public function __construct(){}
    public function guardarUsuario(array $usuario){
        // comprobamos que la carpeta existe o no
        $carpeta = dirname(USUARIOS_JSON);
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0775, true);
        }
        
        // añadimos usuario y guardamos en el archivo
        $usuarios = $this->obtenerUsuarios();
        
        $usuarios[] = $usuario;
        $json = json_encode(
            $usuarios, 
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        
        file_put_contents(USUARIOS_JSON, $json, LOCK_EX);

    }
    public function obtenerUsuarios(){
        if(!file_exists(USUARIOS_JSON))
            return [];
        $json = file_get_contents(USUARIOS_JSON);
        $usuarios = json_decode($json, true);
        return is_array($usuarios) ? $usuarios : [];
    }
}