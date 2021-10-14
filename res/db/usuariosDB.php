<?php
include_once 'conexion.php';

class UsuariosDB
{
    public function getUsuario($usuario)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT idUsuario as id, nombre, apellido, fotografia, usuario, 
            contraseña, u.tipo as idTipo, t.tipo 
            FROM usuario u INNER JOIN tipoUsuario t ON u.tipo = t.idTipo 
            WHERE usuario = ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $usuario);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $usuarios = $stmt->fetch();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $usuarios;
    }

    public function existeUsuario($usuario){
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "SELECT count(*) FROM usuario WHERE usuario.usuario = ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $usuario);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $usuarios = $stmt->fetch();
            if($usuarios[0] == 0){
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

    private function insertaFoto($imagen, $id)
    {
        $direccion = "../res/upload/users/";
        $archivo = basename($imagen['name']);
        list($nombre, $extension) = explode('.', $archivo);
        $nombreArchivo = implode('.', ["user_$id", $extension]);
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

    public function insertUsuario($nombre, $apellido, $foto, $usuario, $contraseña, $tipo)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "INSERT INTO usuario (nombre, apellido, usuario, contraseña, tipo) VALUES (?, ?, ?, ?, ?)";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $apellido);
            $stmt->bindParam(3, $usuario);
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            $stmt->bindParam(4, $contraseña);
            $stmt->bindParam(5, $tipo);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            if ($foto['name'] <> null) {
                $consulta = "SELECT TOP(1) idUsuario as id FROM usuario ORDER BY id desc";
                $stmt = $dbh->prepare($consulta);
                $stmt->execute();
                $id = $stmt->fetch();
                $imagen = $this->insertaFoto($foto, $id[0]);
                $consulta = "UPDATE usuario SET fotografia = ? WHERE idUsuario = ?";
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
