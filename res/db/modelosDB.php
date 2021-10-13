<?php
include_once 'conexion.php';

class ModelosDB
{
    public function getModelos()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT idModelo as id, nombre, version, año, t.transmision
            FROM modelo m INNER JOIN transmision t ON m.idTransmision = t.idTransmision
            ORDER BY nombre";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $modelos = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $modelos;
    }
}
