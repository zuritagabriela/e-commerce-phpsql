<?php

namespace App\Models;

use App\Database\DB;

class EstadoPublicacion
{
    private int $estado_publicacion_id;
    private string $nombre;

    /**
     * @return array|EstadoPublicacion[]
     */
    public function todos(): array
    {
        $db = (new DB())->getConexion();
        $query = "SELECT * FROM estados_publicacion";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_CLASS, EstadoPublicacion::class);
        return $stmt->fetchAll();
    }

    /**
     * @return int
     */
    public function getEstadoPublicacionId(): int
    {
        return $this->estado_publicacion_id;
    }

    /**
     * @param int $estado_publicacion_id
     */
    public function setEstadoPublicacionId(int $estado_publicacion_id): void
    {
        $this->estado_publicacion_id = $estado_publicacion_id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
}
