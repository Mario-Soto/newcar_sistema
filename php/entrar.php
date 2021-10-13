<?php
session_start();
include '../res/db/usuariosDB.php';
$usuariosdb = new UsuariosDB();
$usuario = $usuariosdb->getUsuario($_POST['usuario']);

if($usuario <> null){
    if(password_verify($_POST['contraseña'],$usuario['contraseña'])){
        $_SESSION['usuario'] = $usuario;
        header("Location: ../inicio.php");
    }else{
        header("Location: ../login.php?error=1");
    }
}else{
    header("Location: ../login.php?error=1");
}