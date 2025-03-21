<?php
namespace App\Models;

use App\Database\DB;
use PDO;

class Clientes
{
    private int $idcliente;
    private string $nombre;
    private string $apellido;
    private string $provincia;
    private string $localidad;
    private string $codigo_postal;
    private string $direccion;
    private string $telefono;
    private int $rol_fk;
    private string $email_cliente;
    private string $password;



    public function crear(array $data): void
    {
       
        $db = (new DB)->getConexion();
        $query = "INSERT INTO productos (nombre, apellido, provincia, localidad, codigo_postal, direccion, telefono, rol_fk, email, password)
                VALUES (:nombre, :apellido, :provincia, :localidad, :codigo_postal,  :direccion, :telefono, :rol_fk, :email, :password )";
        $stmt = $db->prepare($query);
        print_r($query);
        $stmt->execute([
            'nombre'              => $data['nombre'],
            'apellido'            => $data['apellido'],
            'provincia'           => $data['provincia'],
            'localidad'           => $data['localidad'],
            'codigo_postal'       => $data['codigo_postal'],
            'direccion'           => $data['direccion'],
            'telefono'            => $data['telefono'],
            'rol_fk'              => $data['rol_fk'],
            'email'               => $data['email'],
            'password'            => $data['password'],
        ]); 
    }

    public function porId(string $id): ?Clientes
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM clientes
                WHERE idcliente = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Clientes::class);
        $usuario = $stmt->fetch();

        if(!$usuario) return null;
        return $usuario;
    }

       public function porEmail(string $email): ?Clientes
        {

            $db = (new DB)->getConexion();
            $query = "SELECT * FROM clientes
                    WHERE email_cliente = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$email]);
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, Clientes::class);
            $usuario = $stmt->fetch();

            if(!$usuario) return null;
            return $usuario;


        }
    
        

    }
    