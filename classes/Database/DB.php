<?php

namespace App\Database;

use Exception;
use PDO;
class DB
{

    protected string $host = '127.0.0.1';
    protected string $user = 'root';
    protected string $pass = '';
    protected string $name = 'dw3_zurita_silvia';

    public function getConexion(): PDO
    { 
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name . ';charset=utf8mb4';

        try {
            $db = new PDO($dsn, $this->user, $this->pass);

            return $db;
        } catch(Exception $e) {
            echo "Error al conectar con MySQL :(<br>";
            echo "El error ocurrido es: " . $e->getMessage();
            exit; 
        }
    }
}
