<?php
session_start();

include '../res/db/usuariosDB.php';
$usuariosdb = new UsuariosDB();

if (isset($_POST['id'])) {
    if ($_POST['contraseña'] <> null) {
        $ret = $usuariosdb->modificaUsuarioPassword($_POST['nombre'], $_POST['apellido'], $_FILES['fotografia'], $_POST['usuario'], $_POST['contraseña'], $_POST['rol'], $_POST['id']);
    } else {
        $ret = $usuariosdb->modificaUsuario($_POST['nombre'], $_POST['apellido'], $_FILES['fotografia'], $_POST['usuario'], $_POST['rol'], $_POST['id']);
    }
    header('Location: ../usuarios.php?modificado=' . $ret);
} else {
    $existe = $usuariosdb->existeUsuario($_POST['usuario']);
    if ($existe == 0) {
        $ret = $usuariosdb->insertUsuario($_POST['nombre'], $_POST['apellido'], $_FILES['fotografia'], $_POST['usuario'], $_POST['contraseña'], $_POST['rol']);
        header('Location: ../altas/usuarios.php?insertado=' . $ret);
    } else {
        header('Location: ../altas/usuarios.php?insertado=' . $existe);
    }
}
