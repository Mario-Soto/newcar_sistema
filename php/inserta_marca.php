<?php
session_start();

include '../res/db/marcasDB.php';
$marcasdb = new MarcasDB();

if (isset($_POST['id'])) {
    $ret = $marcasdb->modificaMarca($_POST['marca'], $_POST['pais'], $_POST['id']);
    header('Location: ../marcas.php?modificado=' . $ret);
} else {
    $ret = $marcasdb->insertMarca($_POST['marca'], $_POST['pais']);
    header('Location: ../altas/marcas.php?insertado=' . $ret);
}
