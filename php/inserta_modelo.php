<?php
session_start();

include '../res/db/modelosDB.php';
$modelosdb = new ModelosDB();

$modelosdb->insertModelo($_POST['modelo'], $_POST['version'], $_POST['año'], $_POST['transmision']);

header('Location: ../altas/modelos.php?insertado=1');