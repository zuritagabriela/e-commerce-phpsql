<?php

namespace App\Models;

use App\Database\DB;
use PDO;

Class Stock{

    public int $idstock;
    private int $producto_fk;
    private int $cantidad;


    public function todas(): array
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM stock";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, Stock::class);
         return $stmt->fetchAll();
    }

    public function crear(): array
    {
        $db = (new DB)->getConexion();
        $query = "INSERT INTO stock(producto_fk, cantidad)
                VALUES (:producto_fk, :cantidad)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'producto_fk'   =>$data['producto_fk'],
            'cantidad'      =>$data['cantidad'],
        ]);
    }

    public function porId (int $id): ?Stock{

        $db = (new DB)->getConexion();
        $query = "SELECT * FROM stock
        WHERE producto_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Stock::class);

        $stcok = $stmt->fetch();

        if(!$stock) return null;

        return $stock;

    }

    public function editar(int $id, int $cantidad)
    {
        $db = (new DB)->getConexion();
        $query = "UPDATE stock
                SET cantidad     = cantidad - $cantidad
                WHERE producto_fk =$id";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

	public function getIdstock() : int {
		return $this->idstock;
	}

	public function setIdstock(int $value) {
		$this->idstock = $value;
	}

	public function getProducto_fk() : int {
		return $this->producto_fk;
	}

	public function setProducto_fk(int $value) {
		$this->producto_fk = $value;
	}

	public function getCantidad() : int {
		return $this->cantidad;
	}

	public function setCantidad(int $value) {
		$this->cantidad = $value;
	}
}