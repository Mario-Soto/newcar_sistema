<?php
session_start();

include '../res/db/usuariosDB.php';
$usuariosdb = new UsuariosDB();

$usuariosdb->insertUsuario($_POST['nombre'], $_POST['apellido'], $_FILES['fotografia'], $_POST['usuario'], $_POST['contraseña'], $_POST['rol']);

header('Location: ../altas/usuarios.php?insertado=1');