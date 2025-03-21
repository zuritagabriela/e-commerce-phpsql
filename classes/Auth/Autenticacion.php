<?php

namespace App\Auth;

use App\Models\Usuarios;

/**
 * Autenticación
 */


class Autenticacion
{
    public function iniciarSesion(string $email, string $password): bool
    {
        $usuario = (new Usuarios)->porEmail($email);
        // Retorna false si no exite.
        if(!$usuario) return false;
        echo 'false';
        // Comparamos el pass. Si no coinside false
        if(!password_verify($password, $usuario->getPassword())) return false;
         $this->marcarComoAutenticado($usuario);
        return true;
    }

    public function marcarComoAutenticado(Usuarios $usuario): void
    {
        $_SESSION['idusuario']  = $usuario->getIdusuario();
        $_SESSION['idrol']      = $usuario->getIdrol_fk();

    }

    public function estaAutenticado(): bool
    {
        return isset($_SESSION['idusuario']);
    }

    public function getIdusuario(): ?int
    {
        return $this->estaAutenticado() ? $_SESSION['idusuario'] : null;
    }

    public function getUsuario(): ?Usuarios
    {
        if(!$this->estaAutenticado()) return null;

        return (new Usuarios)->porId($_SESSION['idusuario']);
    }
    
    public function estaAutenticadoComoAdmin(): bool
    {
        return $this->estaAutenticado() && $_SESSION['idrol'] === 1;
    }

    public function estaAutenticadoComoCliente(): bool
    {
        return $this->estaAutenticado() && $_SESSION['idrol'] === 2;
    }

    public function cerrarSesion(): void
    {
        unset($_SESSION['idusuario']);
    }
}
