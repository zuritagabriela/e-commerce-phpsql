<?php

namespace App\Models;

use App\Database\DB;
use PDO;

Class Colores{

    public int $idcolor;
    private int $producto_fk;
    private string $nombre;
    private string $codigohex;
    private string $estado;


    public function todas(): array
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM colores";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, Colores::class);
         return $stmt->fetchAll();
    }




	public function getIdcolor() : int {
		return $this->idcolor;
	}

	public function setIdcolor(int $value) {
		$this->idcolor = $value;
	}

	public function getProducto_fk() : int {
		return $this->producto_fk;
	}

	public function setProducto_fk(int $value) {
		$this->producto_fk = $value;
	}

	public function getNombre() : string {
		return $this->nombre;
	}

	public function setNombre(string $value) {
		$this->nombre = $value;
	}

	public function getCodigohex() : string {
		return $this->codigohex;
	}

	public function setCodigohex(string $value) {
		$this->codigohex = $value;
	}

	public function getEstado() : string {
		return $this->estado;
	}

	public function setEstado(string $value) {
		$this->estado = $value;
	}
}