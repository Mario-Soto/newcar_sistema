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
            $consulta = "INSERT INTO autos (idMarca, idModelo, idColor, kilometraje, estado, descripcion, precio) VALUES (?, ?, ?, ?, ?, ?, ?)";
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
            if ($foto['name'] <> null) {
                $consulta = "SELECT TOP(1) idAuto as id FROM autos ORDER BY id desc";
                $stmt = $dbh->prepare($consulta);
                $stmt->execute();
                $id = $stmt->fetch();
                $imagen = $this->insertaFoto($foto, $id[0]);
                $consulta = "UPDATE autos SET fotografia = ? WHERE idAuto = ?";
                $stmt = $dbh->prepare($consulta);
                $stmt->bindParam(1, $imagen);
                $stmt->bindParam(2, $id[0]);
                $stmt->execute();
            }
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAutos()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT idAuto as id, ma.nombre as marca, mo.nombre as modelo, version, año, transmision, color, kilometraje, estado, descripcion, CAST(precio AS NUMERIC(10,2)) as precio, fotografia 
            FROM autos a 
            INNER JOIN marca ma ON a.idMarca = ma.idMarca
            INNER JOIN modelo mo ON a.idModelo = mo.idModelo
            INNER JOIN color c ON a.idColor = c.idColor
            INNER JOIN transmision t ON mo.idTransmision = t.idTransmision";
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
            $consulta = "SELECT idAuto as id, ma.nombre as marca, mo.nombre as modelo, version, año, transmision, color, kilometraje, estado, descripcion, CAST(precio AS NUMERIC(10,2)) as precio, fotografia 
            FROM autos a 
            INNER JOIN marca ma ON a.idMarca = ma.idMarca
            INNER JOIN modelo mo ON a.idModelo = mo.idModelo
            INNER JOIN color c ON a.idColor = c.idColor
            INNER JOIN transmision t ON mo.idTransmision = t.idTransmision
            WHERE idAuto = ?";
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
            $consulta = "SELECT idAuto as id, ma.nombre as marca, mo.nombre as modelo, version, año, transmision, color, kilometraje, estado, descripcion, CAST(precio AS NUMERIC(10,2)) as precio, fotografia 
            FROM autos a 
            INNER JOIN marca ma ON a.idMarca = ma.idMarca
            INNER JOIN modelo mo ON a.idModelo = mo.idModelo
            INNER JOIN color c ON a.idColor = c.idColor
            INNER JOIN transmision t ON mo.idTransmision = t.idTransmision
            WHERE ma.nombre LIKE ? OR mo.nombre LIKE ? OR version LIKE ? OR año LIKE ? OR transmision LIKE ?";
            $busca = "%$busca%";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $busca);
            $stmt->bindParam(2, $busca);
            $stmt->bindParam(3, $busca);
            $stmt->bindParam(4, $busca);
            $stmt->bindParam(5, $busca);
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
