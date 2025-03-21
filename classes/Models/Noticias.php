<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Noticias
{
    private int $idnoticia;
    private int $idusuario_fk;
    private string $titulo;
    private string $fecha_publicacion;
    private string $sinopsis;
    private string $texto;
    private ?string $imagen;
    private ?string $imagen_descripcion;

    /**
     * Obtiene todas las noticias.
     *
     * @return Noticias[]  La lista de noticias. Cada noticia es un array con las claves: 'noticia_id', 'titulo', 'sinopsis', ...
     */
    public function todas(): array
    {
//        $data = json_decode(file_get_contents(__DIR__ . '/../data/noticias.json'), true);
//        $noticias = [];
//
//        foreach($data as $datos) {
//            $noticia = new Noticia;
//            $noticia->noticia_id            = $datos['noticia_id'];
//            $noticia->titulo                = $datos['titulo'];
//            $noticia->sinopsis              = $datos['sinopsis'];
//            $noticia->texto                 = $datos['texto'];
//            $noticia->imagen                = $datos['imagen'];
//            $noticia->imagen_descripcion    = $datos['imagen_descripcion'];
//
//            $noticias[] = $noticia;
//        }

        // Obtenemos la conexión con ayuda de nuestra clase DB, y traemos las noticias.
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM noticias";
        $stmt = $db->prepare($query);
        $stmt->execute();

//        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Noticia');
        // En vez de pasar el nombre de la clase como un string, podemos hacerlo con la constante especial
        // de clase "class".
        $stmt->setFetchMode(PDO::FETCH_CLASS, Noticias::class);

        return $stmt->fetchAll();
    }

    /**
     * Obtiene la noticia que corresponde al $id.
     * Si no existe, retorna null.
     *
     * @param int $id
     * @return Noticias|null
     */
    public function porId(int $id): ?Noticias
    {
//        $noticias = $this->todas();
//
//        foreach($noticias as $noticia) {
//            if($noticia->noticia_id == $id) {
//                return $noticia;
//            }
//        }
//
//        return null;
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM noticias
                WHERE idnoticia = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Noticias::class);

        // Como es una búsqueda por PK, no necesitamos hacer un bucle, ya que solo puede haber un resultado.
        $noticia = $stmt->fetch();

        if(!$noticia) return null;

        return $noticia;
    }


	public function getIdnoticia() : int {
		return $this->idnoticia;
	}

	public function setIdnoticia(int $value) {
		$this->idnoticia = $value;
	}

	public function getTitulo() : string {
		return $this->titulo;
	}

	public function setTitulo(string $value) {
		$this->titulo = $value;
	}

	public function getFecha_publicacion() : string {
		return $this->fecha_publicacion;
	}

	public function setFecha_publicacion(string $value) {
		$this->fecha_publicacion = $value;
	}

	public function getSinopsis() : string {
		return $this->sinopsis;
	}

	public function setSinopsis(string $value) {
		$this->sinopsis = $value;
	}

	public function getTexto() : string {
		return $this->texto;
	}

	public function setTexto(string $value) {
		$this->texto = $value;
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


}