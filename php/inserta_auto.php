<?php
session_start();

include '../res/db/autosDB.php';
$autosdb = new AutosDB();

if($_POST['estado'] == 0){
    $kilometraje = 0;
}else{
    $kilometraje = $_POST['kilometraje'];
}

$autosdb->insertAuto($_POST['marca'], $_POST['modelo'], $_POST['color'], $_POST['estado'], $kilometraje, $_POST['descripcion'], $_POST['precio'], $_FILES['fotografia']);

header('Location: ../altas/autos.php?insertado=1');