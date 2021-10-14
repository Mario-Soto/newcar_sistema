<?php
session_start();

include '../res/db/ventasDB.php';
$ventasdb = new VentasDB();

if ($_POST['placas'] <> null) {
    $placa = $_POST['placas'];
    $existe = $ventasdb->existePlaca($placa);
}else{
    $placa = null;
}
$precio = str_replace(',', '', $_POST['total']);

if ($existe == 0) {
    $ventasdb->insertVenta($_POST['auto'], $_POST['cliente'], $_POST['cantidad'], $precio, $placa);
    header('Location: ../ventas/realizar.php?insertado=1');
} else {
    $_SESSION['form-venta'] = $_POST;
    header('Location: ../ventas/realizar.php?error=1');
}
