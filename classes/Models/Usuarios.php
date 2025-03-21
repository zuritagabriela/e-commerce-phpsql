<?php
namespace App\Models;

use App\Database\DB;
use PDO;

class Usuarios
{
    private int $idusuario;
    private ?string $nombre_usuario;
    private string $apellido;
    private string $email;
    private string $password;
    private int $idrol_fk;

    public function crear(array $data): void
    {
        $db = (new DB)->getConexion();
        $query = "INSERT INTO usuarios (nombre_usuario, apellido, email, password, idrol_fk)
                VALUES (:nombre_usuario, :apellido, :email, :password, :idrol_fk)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'nombre_usuario'     => $data['nombre_usuario'],
            'apellido'           => $data['apellido'],
            'email'              => $data['email'],
            'password'           => $data['password'],
            'idrol_fk'           => $data['idrol_fk'],
        ]);
    }


    public function porId(string $id): ?Usuarios
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM usuarios
                WHERE idusuario = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Usuarios::class);
        $usuario = $stmt->fetch();

        if(!$usuario) return null;
        return $usuario;
    }

       public function porEmail(string $email): ?Usuarios
        {

            $db = (new DB)->getConexion();
            $query = "SELECT * FROM usuarios
                    WHERE email = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$email]);
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, Usuarios::class);
            $usuario = $stmt->fetch();

            if(!$usuario) return null;
            return $usuario;


        }
    
        

    public function getIdusuario()
    {
        return $this->idusuario;
    }


    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

 
    public function getNombre_usuario()
    {
        return $this->nombre_usuario;
    }


    public function setNombre_usuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;

        return $this;
    }

   
    public function getApellido()
    {
        return $this->apellido;
    }


    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }
 
    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }


    public function getIdrol_fk()
    {
        return $this->idrol_fk;
    }


    public function setIdrol_fk($idrol_fk)
    {
        $this->idrol_fk = $idrol_fk;

        return $this;
    }
    }
    