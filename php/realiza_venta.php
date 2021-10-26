<?php
session_start();

include '../res/db/ventasDB.php';
$ventasdb = new VentasDB();

if ($_POST['placas'] <> null) {
    $valores = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $placa = $_POST['placas'];
    $existe = $ventasdb->existePlaca($placa);
    while ($existe == 1) {
        $placa = substr(str_shuffle($valores), 0, 7);
        $existe = $ventasdb->existePlaca($placa);
    }
} else {
    $placa = null;
}
$precio = str_replace(',', '', $_POST['precio']);

if ($_POST['forma_pago'] == 1) {
    $plazo = null;
} else {
    $plazo = $_POST['plazo'];
}

if (isset($_POST['id'])) {
    $ret = $ventasdb->modificaVenta($_POST['auto'], $_POST['cliente'], $precio, $placa, $plazo, $_POST['forma_pago'], $_POST['id']);
    header('Location: ../ventas/realizadas.php?modificado=' . $ret);
} else {
    $ret = $ventasdb->insertVenta($_POST['auto'], $_POST['cliente'], $precio, $placa, $plazo, $_POST['forma_pago']);
    header('Location: ../ventas/realizar.php?insertado=' . $ret);
}
