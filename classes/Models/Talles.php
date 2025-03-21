<?php

namespace App\Models;

use App\Database\DB;
use PDO;

Class Talles{

    public int $idtalle;
    private int $producto_fk;
    private string $talle;
    private string $estado;


    public function todas(): array
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM talles ";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, Talles::class);
         return $stmt->fetchAll();
    }

	public function getIdtalle() : int {
		return $this->idtalle;
	}

	public function setIdtalle(int $value) {
		$this->idtalle = $value;
	}

	public function getProducto_fk() : int {
		return $this->producto_fk;
	}

	public function setProducto_fk(int $value) {
		$this->producto_fk = $value;
	}

	public function getTalle() : string {
		return $this->talle;
	}

	public function setTalle(string $value) {
		$this->talle = $value;
	}

	public function getEstado() : string {
		return $this->estado;
	}

	public function setEstado(string $value) {
		$this->estado = $value;
	}
}