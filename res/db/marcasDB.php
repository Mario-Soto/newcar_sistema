<?php
include_once 'conexion.php';

class MarcasDB
{
    public function getMarcas()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT idMarca as id, nombre
            FROM marca m ORDER BY nombre";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $marcas = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $marcas;
    }
}
