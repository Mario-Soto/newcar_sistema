<?php
session_start();

include '../res/db/autosDB.php';
$autosdb = new AutosDB();

if($_POST['estado'] == 0){
    $kilometraje = 0;
}else{
    $kilometraje = str_replace(',','',$_POST['kilometraje']);
}

$precio = str_replace(',','',$_POST['precio']);

$autosdb->insertAuto($_POST['marca'], $_POST['modelo'], $_POST['color'], $_POST['estado'], $kilometraje, $_POST['descripcion'], $precio, $_FILES['fotografia']);

header('Location: ../altas/autos.php?insertado=1');