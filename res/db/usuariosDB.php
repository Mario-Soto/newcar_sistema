<?php
include_once 'conexion.php';

class UsuariosDB
{
    public function getUsuario($usuario)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarUsuario ?";
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

    public function getUsuarios()
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC mostrarUsuarios";
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $usuarios = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $usuarios;
    }

    public function existeUsuario($usuario)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE @ret int;
            EXEC @ret = existeUsuario ?
            SELECT @ret as ret";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $return, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, PDO::SQLSRV_PARAM_OUT_DEFAULT_SIZE);
            $stmt->bindParam(2, $usuario);
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

    public function buscaUsuarios($usuario)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC buscarUsuario ?";
            $stmt = $dbh->prepare($consulta);
            $usuario = "%$usuario%";
            $stmt->bindParam(1, $usuario);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $return = $stmt->fetchAll();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $return;
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
            $consulta = "DECLARE @id int, @ret int;
            EXEC @ret = insertarUsuario @id output, ?, ?, ?, ?, ?;
            SELECT @id as id, @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $apellido);
            $stmt->bindParam(3, $usuario);
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            $stmt->bindParam(4, $contraseña);
            $stmt->bindParam(5, $tipo);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while ($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $id = $valor[0];
            $return = $valor[1];
            if ($foto['name'] <> null) {
                $imagen = $this->insertaFoto($foto, $id);
                $consulta = "EXEC insertarFotoUsuario ?, ?";
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

    public function modificaUsuarioPassword($nombre, $apellido, $foto, $usuario, $contraseña, $tipo, $id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE @ret int;
            EXEC @ret = insertarUsuario ?, ?, ?, ?, ?, ?;
            SELECT @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $nombre);
            $stmt->bindParam(3, $apellido);
            $stmt->bindParam(4, $usuario);
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            $stmt->bindParam(5, $contraseña);
            $stmt->bindParam(6, $tipo);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while ($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $return = $valor[0];
            if ($foto['name'] <> null) {
                $imagen = $this->insertaFoto($foto, $id);
                $consulta = "EXEC insertarFotoUsuario ?, ?";
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

    public function modificaUsuario($nombre, $apellido, $foto, $usuario, $tipo, $id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DECLARE @ret int;
            EXEC @ret = modificarUsuario ?, ?, ?, ?, ?;
            SELECT @ret as ret;";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $nombre);
            $stmt->bindParam(3, $apellido);
            $stmt->bindParam(4, $usuario);
            $stmt->bindParam(5, $tipo);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            while ($stmt->columnCount() === 0 && $stmt->nextRowset());
            $valor = $stmt->fetch();
            $return = $valor[0];
            if ($foto['name'] <> null) {
                $imagen = $this->insertaFoto($foto, $id);
                $consulta = "EXEC insertarFotoUsuario ?, ?";
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

    public function modificaPassword($contraseña, $id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "EXEC modificaPassword ?, ?";
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $id);
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            $stmt->bindParam(2, $contraseña);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function elimina($id)
    {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = "DELETE FROM usuario WHERE usuario = ?";
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
