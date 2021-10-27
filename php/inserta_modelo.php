<?php
session_start();

include '../res/db/modelosDB.php';
$modelosdb = new ModelosDB();

if (isset($_POST['id'])) {
    $ret = $modelosdb->modificaModelo($_POST['modelo'], $_POST['año'], $_POST['transmision'], $_POST['id']);
    header('Location: ../modelos.php?modificado=' . $ret);
} else {
    $ret = $modelosdb->insertModelo($_POST['modelo'], $_POST['año'], $_POST['transmision']);
    header('Location: ../altas/modelos.php?insertado=' . $ret);
}
