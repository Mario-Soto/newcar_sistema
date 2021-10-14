<?php
session_start();

include '../res/db/clientesDB.php';
$clientesdb = new ClientesDB();

$clientesdb->insertCliente($_POST['nombre'], $_POST['apellido'], $_POST['rfc'], $_POST['credito']);

header('Location: ../altas/clientes.php?insertado=1');