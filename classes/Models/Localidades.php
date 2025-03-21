<?php
namespace App\Models;

use App\Database\DB;
use PDO;

class Localidades
{
    private int $idlocalidad;
    private string $nombre;
    private int $provincia_fk;



    public function todas(): array
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM localidades";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, Localidades::class);
         return $stmt->fetchAll();
    }

	public function getIdlocalidad() : int {
		return $this->idlocalidad;
	}

	public function setIdlocalidad(int $value) {
		$this->idlocalidad = $value;
	}
    public function getNombre() : string {
		return $this->nombre;
	}

	public function setNombre(string $value) {
		$this->nombre = $value;
	}

    public function getProvincia_fk() : int {
		return $this->provincia_fk;
	}

	public function setProvincia_fk(int $value) {
		$this->provincia_fk = $value;
	}
    
        

    }
    