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
}
