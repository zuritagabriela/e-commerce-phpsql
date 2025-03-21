<?php

namespace App\Models;
use App\Auth\Autenticacion;
 use App\Database\DB;
 Use PDO;

 Class Ventas{

    public int $idventa;
    private int $usuario_fk;
	private string $estado;
	private string $idorden;
    private string $fecha;


    public function crear(array $data)
    {
	    $db = (new DB)->getConexion();
        $query = "INSERT INTO ventas (usuario_fk, estado, idorden, fecha) 
        VALUES (:usuario_fk, :estado, :idorden, :fecha)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'usuario_fk'      => $data['usuario_fk'],
			'estado'          => $data['estado'],
			'idorden'         => $data['idorden'],
            'fecha'           => $data['fecha'],
        ]); 
    }


    public function todas(): array
    {
		$registros = [
			'idorden' 			=> '',
			'fecha' 			=> '',
		];
	
        $db = (new DB)->getConexion();
        $query = " SELECT DISTINCT (ca.idorden), ca.usuario_fk, v.fecha,
		SUM(ca.cantidad * pr.precio) AS total,
		GROUP_CONCAT(ca.producto_fk, '..', pr.nombre_producto, '..', ca.cantidad SEPARATOR '__') AS carrito
		FROM carrito ca
		INNER JOIN ventas v ON v.idorden = ca.idorden
		INNER JOIN productos pr ON ca.producto_fk = pr.idproducto
		GROUP BY v.idorden ORDER BY v.idorden ;";
        $stmt = $db->prepare($query);
        $stmt->execute();
		$registros=$stmt->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	
        
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
		return $this->idorden;
	}

	public function setIdorden(int $value) {
		$this->idorden = $value;
	}

	public function getFecha() : string {
		return $this->fecha;
	}

	public function setFecha(string $value) {
		$this->fecha = $value;
	}


}