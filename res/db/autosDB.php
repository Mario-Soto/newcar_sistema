<?php
include_once 'conexion.php';

class AutosDB
{
    private function insertaFoto($imagen, $id)
    {
        $direccion = "../res/upload/autos/";
        $archivo = basename($imagen['name']);
        list($nombre, $extension) = explode('.', $archivo);
        $nombreArchivo = implode('.', ["auto_$id", $extension]);
        $path = $direccion . $nombreArchivo;
        $tipo = pathinfo($path, PATHINFO_EXTENSION);
        $status = " ";
        try {
            if (!empty($imagen['name'])) {
                $tiposPermitidos = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($tipo, $tiposPermitidos)) {
                    if (move_uploaded_file($imagen['tmp_name'], $path)) {
                        $status = 'Correcto';
                    } else {
                        $status = "Ocurrió un error durante la subida del archivo";
                    }
                } else {
                    $status = "Extensión de archivo no permitido";
                }
            } else {
                $status = "No se ha elegido un archivo";
            }
            // print($status);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $nombreArchivo;
    }

    public function insertAuto($marca, $modelo, $color, $estado, $kilometraje, $descripcion, $precio, $foto)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE @id int, @ret int;
            EXEC @ret = insertaAuto  @id output, ?, ?, ?, ?, ?, ?, ?;
            SELECT @id as id, @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $marca);
            $stmt->bindParam(2, $modelo);
            $stmt->bindParam(3, $color);
            $stmt->bindParam(4, $kilometraje);
            $stmt->bindParam(5, $estado);
            $stmt->bindParam(6, $descripcion);
            $stmt->bindParam(7, $precio);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $id = $valor[0];
            $return = $valor[1];
            if ($foto['name'] <> null) {
                $imagen = $this->insertaFoto($foto, $id);
                $consulta = "EXEC insertaFotoAuto ?, ?";
                $stmt = $dbh->prepare($consulta);
                $stmt->bindParam(1, $imagen);
                $stmt->bindParam(2, $id);
                $stmt->execute();
            }
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $return;
    }

    public function modificaAuto($marca, $modelo, $color, $estado, $kilometraje, $descripcion, $precio, $foto, $id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE @ret int;
            EXEC @ret = modificaAuto ?,?,?,?,?,?,?,?;
            SELECT @ret as ret";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $marca);
            $stmt->bindParam(3, $modelo);
            $stmt->bindParam(4, $color);
            $stmt->bindParam(5, $kilometraje);
            $stmt->bindParam(6, $estado);
            $stmt->bindParam(7, $descripcion);
            $stmt->bindParam(8, $precio);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while ($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $return = $valor[0];
            if ($foto['name'] <> null) {
                $imagen = $this->insertaFoto($foto, $id);
                $consulta = "EXEC insertaFotoAuto ?, ?";
                $stmt = $dbh->prepare($consulta);
                $stmt->bindParam(1, $imagen);
                $stmt->bindParam(2, $id);
                $stmt->execute();
            }
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $return;
    }

    public function getAutos()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarAutos";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $autos = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $autos;
    }

    public function getAutoPorId($id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarAutosId ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $autos = $stmt->fetch();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $autos;
    }

    public function buscaAutos($busca)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC buscarAuto ?";
            $busca = "%$busca%";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $busca);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $autos = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $autos;
    }
}
