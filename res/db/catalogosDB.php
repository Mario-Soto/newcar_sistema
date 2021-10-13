<?php
include_once 'conexion.php';

class CatalogosDB
{
    public function getTransmisiones()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT idTransmision as id, transmision
            FROM transmision t ORDER BY id";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $transmisiones = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $transmisiones;
    }

    public function getColores()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT idColor as id, color FROM color
            ORDER BY color";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $colores = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $colores;
    }

    public function getPaises()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT idPais as id, pais FROM paises
            ORDER BY pais";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $paises = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $paises;
    }

    public function getRoles()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT idTipo as id, tipo FROM tipoUsuario
            ORDER BY id";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $roles = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $roles;
    }
}
