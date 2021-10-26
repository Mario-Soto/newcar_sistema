<?php
include_once 'conexion.php';

class ClientesDB
{
    public function insertCliente($nombre, $apellido, $rfc, $credito)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE @id int, @ret int;
            EXEC @ret = insertarCliente @id output, ?, ?, ?, ?;
            SELECT @id as id, @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $apellido);
            $stmt->bindParam(3, $rfc);
            $stmt->bindParam(4, $credito);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $id = $valor[0];
            $return = $valor[1];
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $return;
    }

    public function modificaCliente($nombre, $apellido, $rfc, $credito, $id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE @ret int;
            EXEC @ret = modificarCliente ?, ?, ?, ?, ?;
            SELECT @ret as ret";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $nombre);
            $stmt->bindParam(3, $apellido);
            $stmt->bindParam(4, $rfc);
            $stmt->bindParam(5, $credito);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while ($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $return = $valor[0];
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $return;
    }

    public function getClientes()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarClientes";
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

    public function getClientePorId($id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarClienteId ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $clientes = $stmt->fetch();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $clientes;
    }

    public function buscaCliente($busca)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC buscarClientes ?";
            $stmt = $dbh->prepare($consulta);
            $busca = "%$busca%";
            $stmt->bindParam(1, $busca);
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
