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
            print($foto['name'].'<br>');
            if ($foto['name'] <> null) {
                $consulta = "SELECT TOP(1) idAuto as id FROM autos ORDER BY id desc";
                $stmt = $dbh->prepare($consulta);
                $stmt->execute();
                $id = $stmt->fetch();
                print($id[0].'<br>');
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
}
