<?php

namespace App\Models;

 use App\Database\DB;
 Use PDO;

 Class Ordenes{

    private int $idorden;
	private string $estado;


    public function crear(array $data)
    {
	    $db = (new DB)->getConexion();
        $query = "INSERT INTO ordenes (idorden,  estado) 
        VALUES (:idorden, :estado)";
        $stmt = $db->prepare($query);
        print_r($query);
        $stmt->execute([
			'idorden'       		  => $data['idorden'],
			'estado'         		  => $data['estado'],
        ]); 
    }

	public function getIdorden() : int {
		return $this->idorden;
	}

	public function setIdorden(int $value) {
		$this->idorden = $value;
	}

	public function getEstado() : string {
		return $this->estado;
	}

	public function setEstado(string $value) {
		$this->estado = $value;
	}
}