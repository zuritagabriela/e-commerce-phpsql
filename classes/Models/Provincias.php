<?php
namespace App\Models;

use App\Database\DB;
use PDO;

class Provincias
{
    private int $idprovincia;
    private string $nombre;


    public function todas(): array
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM provincias";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, Provincias::class);
         return $stmt->fetchAll();
    }

	public function getIdprovincia() : int {
		return $this->idprovincia;
	}

	public function setIdprovincia(int $value) {
		$this->idprovincia = $value;
	}
    public function getNombre() : string {
		return $this->nombre;
	}

	public function setNombre(string $value) {
		$this->nombre = $value;
	}

}
    