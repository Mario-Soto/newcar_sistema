<?php
session_start();

include '../res/db/usuariosDB.php';
$usuariosdb = new UsuariosDB();

$existe = $usuariosdb->existeUsuario($_POST['usuario']);

if($existe == 0){
    $usuariosdb->insertUsuario($_POST['nombre'], $_POST['apellido'], $_FILES['fotografia'], $_POST['usuario'], $_POST['contraseña'], $_POST['rol']);
    header('Location: ../altas/usuarios.php?insertado=1');
}else{
    $_SESSION['form-usuario'] = $_POST;
    header('Location: ../altas/usuarios.php?error=1');
}