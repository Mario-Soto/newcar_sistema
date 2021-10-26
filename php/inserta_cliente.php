<?php
session_start();

include '../res/db/clientesDB.php';
$clientesdb = new ClientesDB();

if ($_POST['credito']) {
    $credito = 1;
} else {
    $credito = 0;
}
if (isset($_POST['id'])) {
    $ret = $clientesdb->modificaCliente($_POST['nombre'], $_POST['apellido'], $_POST['rfc'], $credito, $id);
    header('Location: ../clientes.php?modificado=' . $ret);
} else {
    $ret = $clientesdb->insertCliente($_POST['nombre'], $_POST['apellido'], $_POST['rfc'], $credito);
    header('Location: ../altas/clientes.php?insertado=' . $ret);
}
