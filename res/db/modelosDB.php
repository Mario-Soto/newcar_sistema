<?php
include_once 'conexion.php';

class ModelosDB
{
    public function getModelos()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarModelos";
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

    public function getModeloPorId($id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarModeloId ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $modelos = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $modelos;
    }

    public function buscaModelo($busca)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC buscarModelos ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $busca = "%$busca%";
            $stmt->bindParam(1, $busca);
            $stmt->execute();
            $modelos = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $modelos;
    }

    public function insertModelo($nombre, $año, $transmision)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE @id int, @ret int;
            EXEC @ret = insertarModelo @id output, ?, ?, ?;
            SELECT @id as id, @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $año);
            $stmt->bindParam(3, $transmision);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while ($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $id = $valor[0];
            $return = $valor[1];
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $return;
    }

    public function modificaModelo($nombre, $año, $transmision, $id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE  @ret int;
            EXEC @ret = insertarModelo ?, ?, ?, ?;
            SELECT  @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $nombre);
            $stmt->bindParam(3, $año);
            $stmt->bindParam(4, $transmision);
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
    public function elimina($id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DELETE FROM modelo WHERE idModelo = ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
