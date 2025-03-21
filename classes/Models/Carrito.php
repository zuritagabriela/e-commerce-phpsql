<?php

namespace App\Models;

 use App\Database\DB;
 Use PDO;

 Class Carrito{

    public int $idcarrito;
    private string $idorden;
    private int $usuario_fk;
    private int $producto_fk;
    private int $cantidad;
    private string $color;
    private string $talle;
    private string $estado;


    public function crear(array $data)
    {
        $db = (new DB)->getConexion();
        $query = "INSERT INTO carrito (idorden, usuario_fk, producto_fk, cantidad, color, talle, estado) 
        VALUES (:idorden,  :usuario_fk, :producto_fk, :cantidad, :color, :talle, :estado)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'idorden'        => $data['idorden'],
            'usuario_fk'     => $data['usuario_fk'],
            'producto_fk'    => $data['producto_fk'],
            'cantidad'       => $data['cantidad'],
            'color'          => $data['color'],
            'talle'          => $data['talle'],
            'estado'         => $data['estado'],
        ]); 
    }

    public function todas(): array
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM carrito";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Carrito::class);
         return $stmt->fetchAll();
    }

    public function porId(int $id): ?Carrito
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM carrito WHERE producto_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Carrito::class);
        $producto = $stmt->fetch();
        if(!$producto) return null;
        return $producto;
    }

    public function porIdcarrito(int $id): ?Carrito
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM carrito WHERE idcarrito = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Carrito::class);
        $resultado = $stmt->fetch();
        if(!$resultado) return null;
        return $resultado;
    }

    public function prodCoincide(int $id, string $color, string $talle)
    {
        
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM carrito WHERE producto_fk = ? AND color = '$color' AND talle = '$talle' AND estado = 'sin finalizar' ";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Carrito::class);
        $resultado = $stmt->fetch();
        return $resultado; 

    }

    public function editarCantidad(int $id, string $color, string $talle, int $cantidad)
    {
        $db = (new DB)->getConexion();
        $query = "UPDATE carrito SET cantidad = $cantidad + cantidad WHERE producto_fk  = $id AND color = '$color' AND talle = '$talle'";
        $stmt = $db->prepare($query);
        $stmt->execute();

    }

    public function editarEstado(int $id, array $data)
    {
        $db = (new DB)->getConexion();
        $query = "UPDATE carrito SET estado = :estado WHERE usuario_fk = :usuario_fk";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'usuario_fk' => $id,
            'estado'     => $data['estado'],
        ]);
    }


    public function eliminar(int $id)
    {
     
        $db = (new DB)->getConexion();
        $query = "DELETE FROM carrito WHERE idcarrito = ? ";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }

    public function eliminarCarrito(int $id)
    {
        print_r($idcarrito);
        $db = (new DB)->getConexion();
        $query = "DELETE FROM carrito WHERE producto_fk = ? ";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }

	public function getIdcarrito() : int {
		return $this->idcarrito;
	}

	public function setIdcarrito(int $value) {
		$this->idcarrito = $value;
	}

	public function getIdorden() : int {
		return $this->idorden;
	}

	public function setIdorden(int $value) {
		$this->idorden = $value;
	}

	public function getUsuario_fk() : int {
		return $this->usuario_fk;
	}

	public function setUsuario_fk(int $value) {
		$this->usuario_fk = $value;
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

	public function getColor() : string {
		return $this->color;
	}

	public function setColor(string $value) {
		$this->color = $value;
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