<?php
include_once 'conexion.php';

class ClientesDB
{
    public function insertCliente($nombre, $apellido, $rfc, $credito)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "INSERT INTO clientes (nombre, apellido, rfc, credito) VALUES (?, ?, ?, ?)";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $apellido);
            $stmt->bindParam(3, $rfc);
            $stmt->bindParam(4, $credito);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getClientes()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT idCliente as id, nombre, apellido, rfc, credito FROM clientes ORDER BY apellido";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $clientes = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $clientes;
    }
}
