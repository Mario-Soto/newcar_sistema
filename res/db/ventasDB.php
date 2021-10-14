<?php
include_once 'conexion.php';

class VentasDB
{
    // public function getVentas()
    // {
    //     $conexion = Conexion::getInstancia();
    //     $dbh = $conexion->getDbh();
    //     try {
    //         $consulta = "SELECT idVenta as id, nombre
    //         FROM marca m ORDER BY nombre";
    //         $stmt = $dbh->prepare($consulta);
    //         $stmt->setFetchMode(PDO::FETCH_BOTH);
    //         $stmt->execute();
    //         $marcas = $stmt->fetchAll();
    //         $dbh = null;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    //     return $marcas;
    // }

    public function insertVenta($auto, $cliente, $cantidad, $total, $placa)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "INSERT INTO venta (idAuto, idCliente, cantidad, total, placa) VALUES (?, ?, ?, ?, ?)";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $auto);
            $stmt->bindParam(2, $cliente);
            $stmt->bindParam(3, $cantidad);
            $stmt->bindParam(4, $total);
            $stmt->bindParam(5, $placa);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function existePlaca($placa){
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT count(*) FROM ventas WHERE placa = ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $placa);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $placas = $stmt->fetch();
            if($placas[0] == 0){
                $val = 0;
            }else{
                $val = 1;
            }
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $val;
    }
}
