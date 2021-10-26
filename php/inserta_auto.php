<?php
session_start();

include '../res/db/autosDB.php';
$autosdb = new AutosDB();

if ($_POST['estado'] == 0) {
    $kilometraje = 0;
} else {
    $kilometraje = str_replace(',', '', $_POST['kilometraje']);
}

$precio = str_replace(',', '', $_POST['precio']);

if (isset($_POST['id'])) {
    $ret = $autosdb->modificaAuto($_POST['marca'], $_POST['modelo'], $_POST['color'], $_POST['estado'], $kilometraje, $_POST['descripcion'], $precio, $_FILES['fotografia'], $_POST['id']);
    header('Location: ../inventario.php?modificado=' . $ret);
} else {
    $ret = $autosdb->insertAuto($_POST['marca'], $_POST['modelo'], $_POST['color'], $_POST['estado'], $kilometraje, $_POST['descripcion'], $precio, $_FILES['fotografia']);
    header('Location: ../altas/autos.php?insertado=' . $ret);
}
