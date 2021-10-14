<?php
session_start();

include '../res/db/marcasDB.php';
$marcasdb = new MarcasDB();

$marcasdb->insertMarca($_POST['marca'], $_POST['pais']);

header('Location: ../altas/marcas.php?insertado=1');