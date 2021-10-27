<?php
session_start();
include '../res/db/usuariosDB.php';
$usuariosdb = new UsuariosDB();

if (isset($_POST['contraseña'])) {
    $usuariosdb->modificaPassword($_POST['contraseña'], $_SESSION['usuario']['id']);
    header("Location: ../perfil.php");
} else {
    $ret = $usuariosdb->modificaUsuario($_POST['nombre'], $_POST['apellido'], $_POST['fotografia'], $_POST['usuario'], $_SESSION['usuario']['rol'], $_SESSION['usuario']['id']);
    header("Location: ../perfil.php?modificado=" . $ret);
}
