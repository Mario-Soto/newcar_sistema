<?php
include_once 'conexion.php';

class VentasDB
{
    public function getVentas()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarVentas";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $ventas = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $ventas;
    }

    public function getVentaPorId($id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarVentaId ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $ventas = $stmt->fetch();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $ventas;
    }

    public function buscaVenta($busca)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC buscarVentas ?";
            $stmt = $dbh->prepare($consulta);
            $busca = "%$busca%";
            $stmt->bindParam(1, $busca);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $ventas = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $ventas;
    }

    public function insertVenta($auto, $cliente, $total, $placa, $plazo, $pago)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE @id int, @ret int;
            EXEC @ret = insertarVenta @id output, ?, ?, ?, ?, ?, ?;
            SELECT @id as id, @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $auto);
            $stmt->bindParam(2, $cliente);
            $stmt->bindParam(3, $total);
            $stmt->bindParam(4, $placa);
            $stmt->bindParam(5, $plazo);
            $stmt->bindParam(6, $pago);
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

    public function modificaVenta($auto, $cliente, $total, $placa, $plazo, $pago, $id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE  @ret int;
            EXEC @ret = modificarVenta ?, ?, ?, ?, ?, ?, ?;
            SELECT @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $auto);
            $stmt->bindParam(3, $cliente);
            $stmt->bindParam(4, $total);
            $stmt->bindParam(5, $placa);
            $stmt->bindParam(6, $plazo);
            $stmt->bindParam(7, $pago);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $return = $valor[0];
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $return;
    }

    public function existePlaca($placa)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        $return = '';
        try {
            $consulta = "DECLARE @ret int;
            EXEC @ret = existePlaca ?;
            SELECT @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $placa);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $return = $valor[0];
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $return;
    }
}
