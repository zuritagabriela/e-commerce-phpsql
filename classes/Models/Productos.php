<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Productos
{
    private int $idproducto;
    private string $nombre_producto;
    private float $precio;
    private int $idusuario_fk;
    private ?string $imagen;
    private ?string $imagen_descripcion;
    private string $texto;
    private string $clase;
    private string $amortiguador;
    private string $rueda;
    private string $cubiertas;
    private string $sillin;
    private string $bateria;
    private string $categoria;


    /**

     *
     * @return Productos[] 
     */
    public function todas(): array
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM productos";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, Productos::class);
        return $stmt->fetchAll();

    }

    public function todasPaginacion(int $porPagina = 2, int $pagina = 1): array
    {
        $queryParams = [];
		$productos = [];
		$paginacion = [
            'porPagina' => $porPagina,
            'pagina' => $pagina,
            'offset' => $porPagina * ($pagina - 1),
        ];
		$db = (new DB)->getConexion();

		$queryConstraints = "SELECT * FROM productos";
		$query = $queryConstraints . " LIMIT " . $paginacion['porPagina'] . " OFFSET " . $paginacion['offset'];
        $stmt = $db->prepare($query);
        $stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, Productos::class); 
		$productos = $stmt->fetchAll();
        
		$queryTotal = "SELECT COUNT(*) AS total FROM productos";
        $stmtTotal = $db->prepare($queryTotal);
        $stmtTotal->execute($queryParams);
        $totalData = $stmtTotal->fetch(PDO::FETCH_ASSOC);
		$paginacion['totalRegistros'] = $totalData['total'];
		$paginacion['totalPaginas'] = ceil($totalData['total'] / $paginacion['porPagina']);
        return [$productos, $paginacion];
    }

    public function solotres(): array
    {
        
        $db = (new DB)->getConexion();
        
        $queryupdate = "UPDATE productos SET clase  = 'active'
        where precio BETWEEN 100 and 200 limit 1" ;
        $stmtp = $db->prepare($queryupdate);
        $stmtp->execute();

        $query = "SELECT * FROM productos
        where precio BETWEEN 100 and 200 
        limit 3";
        $stmt = $db->prepare($query);
        $stmt->execute();
        // PDO::FETCH_CLASS->devuelve una nueva instancia de la clase solicitada
        $stmt->setFetchMode(PDO::FETCH_CLASS, Productos::class);
        return $stmt->fetchAll();
    }



    /**
     *
     * @param int $id
     * @return Productos|null
     */
    public function porId(int $id): ?Productos
    {
       
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM productos
                WHERE idproducto = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Productos::class);

        $bicicletas = $stmt->fetch();

        if(!$bicicletas) return null;

        return $bicicletas;
    }

    public function crear(array $data)
    {
       
        $db = (new DB)->getConexion();
        $query = "INSERT INTO productos (nombre_producto, precio, imagen, imagen_descripcion, texto, clase, amortiguador, rueda, cubiertas, sillin, bateria, categoria)
                VALUES (:nombre_producto, :precio, :imagen, :imagen_descripcion, :texto, :clase, :amortiguador, :rueda, :cubiertas, :sillin, :bateria, :categoria )";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'nombre_producto'            => $data['nombre_producto'],
            'precio'                     => $data['precio'],
            'imagen'                     => $data['imagen'],
            'imagen_descripcion'         => $data['imagen_descripcion'],
            'texto'                      => $data['texto'],
            'clase'                      => $data['clase'],
            'amortiguador'               => $data['amortiguador'],
            'rueda'                      => $data['rueda'],
            'cubiertas'                  => $data['cubiertas'],
            'sillin'                     => $data['sillin'],
            'bateria'                    => $data['bateria'],
            'categoria'                  => $data['categoria'],
        ]); 
    }



    public function editar(int $id, array $data)
    {
        $db = (new DB)->getConexion();
       
        $query = "UPDATE productos
                SET nombre_producto     = :nombre_producto,
                    precio              = :precio,
                    imagen              = :imagen,
                    imagen_descripcion  = :imagen_descripcion,
                    texto               = :texto
                WHERE idproducto = :idproducto";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'idproducto'            => $id,
            'nombre_producto'       => $data['nombre_producto'],
            'precio'                => $data['precio'],
            'imagen'                => $data['imagen'],
            'imagen_descripcion'    => $data['imagen_descripcion'],
            'texto'                 => $data['texto'],
        ]);
    }

    public function eliminar(int $id)
    {

        // $this->desvincularUsuario($id);

        $db = (new DB)->getConexion();
        $query = "DELETE FROM productos
                WHERE idproducto= ? ";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        print_r($stmt);
    }


   
    
    // public function desvincularUsuario(int $id): void
    // {
    //     $db = (new DB())->getConexion();
    //     $query = "DELETE FROM productos_imagenes
    //             WHERE idproducto_fk = ?";
    //     $stmt = $db->prepare($query);
    //     $stmt->execute([$id]);
    // }

	public function getIdproducto() : int {
		return $this->idproducto;
	}

	public function setIdproducto(int $value) {
		$this->idproducto = $value;
	}

	public function getNombre_producto() : string {
		return $this->nombre_producto;
	}

	public function setNombre_producto(string $value) {
		$this->nombre_producto = $value;
	}

	public function getPrecio() : float {
		return $this->precio;
	}

	public function setPrecio(float $value) {
		$this->precio = $value;
	}

	public function getIdusuario_fk() : int {
		return $this->idusuario_fk;
	}

	public function setIdusuario_fk(int $value) {
		$this->idusuario_fk = $value;
	}

	public function getImagen() : ?string {
		return $this->imagen;
	}

	public function setImagen(?string $value) {
		$this->imagen = $value;
	}

	public function getImagen_descripcion() : ?string {
		return $this->imagen_descripcion;
	}

	public function setImagen_descripcion(?string $value) {
		$this->imagen_descripcion = $value;
	}

	public function getTexto() : string {
		return $this->texto;
	}

	public function setTexto(string $value) {
		$this->texto = $value;
	}

	public function getClase() : string {
		return $this->clase;
	}

	public function setClase(string $value) {
		$this->clase = $value;
	}

	public function getAmortiguador() : string {
		return $this->amortiguador;
	}

	public function setAmortiguador(string $value) {
		$this->amortiguador = $value;
	}

	public function getRueda() : string {
		return $this->rueda;
	}

	public function setRueda(string $value) {
		$this->rueda = $value;
	}

	public function getCubiertas() : string {
		return $this->cubiertas;
	}

	public function setCubiertas(string $value) {
		$this->cubiertas = $value;
	}

	public function getSillin() : string {
		return $this->sillin;
	}

	public function setSillin(string $value) {
		$this->sillin = $value;
	}

	public function getBateria() : string {
		return $this->bateria;
	}

	public function setBateria(string $value) {
		$this->bateria = $value;
	}

	public function getCategoria() : string {
		return $this->categoria;
	}

	public function setCategoria(string $value) {
		$this->categoria = $value;
	}
}