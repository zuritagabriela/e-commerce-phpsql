<?php

namespace App\Models;

 use App\Database\DB;
 Use PDO;

 Class Ventas{

    public int $idventa;
    private int $usuario_fk;
	private string $estado;
	private int $idorden;
	private string $fecha;


    public function crear(array $data)
    {
	    $db = (new DB)->getConexion();
        $query = "INSERT INTO ventas (usuario_fk, estado, idorden, fecha) 
        VALUES (:usuario_fk, :estado, :idorden, fecha)";
        $stmt = $db->prepare($query);
        print_r($query);
        $stmt->execute([
            'usuario_fk'              => $data['usuario_fk'],
			'estado'         		  => $data['estado'],
			'idorden'                 => $data['idorden'],
			'fecha  '                 => $data['fecha'],
        ]); 
    }

	public function getIdventa() : int {
		return $this->idventa;
	}

	public function setIdventa(int $value) {
		$this->idventa = $value;
	}

	public function getUsuario_fk() : int {
		return $this->usuario_fk;
	}

	public function setUsuario_fk(int $value) {
		$this->usuario_fk = $value;
	}

	public function getEstado() : string {
		return $this->estado;
	}

	public function setEstado(string $value) {
		$this->estado = $value;
	}

	public function getIdorden() : int {
		return $this->idorden_fk;
	}

	public function setIdorden(int $value) {
		$this->idorden_fk = $value;
	}

	public function getFecha() : string {
		return $this->fecha;
	}

	public function setFecha(string $value) {
		$this->fecha = $value;
	}
}