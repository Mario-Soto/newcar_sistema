<?php
session_start();
if (isset($_SESSION['usuario'])) {
    if (isset($_GET['auto'])) {
        include '../res/db/autosDB.php';
        $bd = new AutosDB();
        $id = $_GET['auto'];
    } else if (isset($_GET['usuario'])) {
        include '../res/db/usuariosDB.php';
        $bd = new UsuariosDB();
        $id = $_GET['usuario'];
    } else if (isset($_GET['modelo'])) {
        include '../res/db/modelosDB.php';
        $bd = new ModelosDB();
        $id = $_GET['modelo'];
    } else if (isset($_GET['marca'])) {
        include '../res/db/marcasDB.php';
        $bd = new MarcasDB();
        $id = $_GET['marca'];
    } else if (isset($_GET['cliente'])) {
        include '../res/db/clientesDB.php';
        $bd = new ClientesDB();
        $id = $_GET['cliente'];
    } else if (isset($_GET['venta'])) {
        include '../res/db/ventasDB.php';
        $bd = new VentasDB();
        $id = $_GET['venta'];
    }

    $bd->elimina($id);
    header('Location: ' . getenv('HTTP_REFERER'));
}
else{
    header('Location: ../inicio.php');
}