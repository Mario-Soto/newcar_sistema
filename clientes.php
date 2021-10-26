<?php
session_start();
include 'res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include 'res/layout/nav.php';
    include 'res/layout/header.html';
    include 'res/db/clientesDB.php';
    $clientesdb = new ClientesDB();
    if (isset($_GET['buscar'])) {
        $clientes = $clientesdb->buscaCliente($_GET['buscar']);
    } else {
        $clientes = $clientesdb->getClientes();
    }
?>
    <h1 class="text-center">Clientes</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get" class="row mb-4 mt-2">
        <div class="row justify-content-center">
            <div class="col-8 col-md-7 col-lg-6">
                <input type="search" name="buscar" id="buscar" placeholder="Realiza tu búsqueda" class="form-control" required>
            </div>
            <div class="col-1">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <table class="table table-striped table-hover bg-c1">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>RFC</th>
                <th>Crédito</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($clientes as $cliente) :
            ?>
                <tr>
                    <td>
                        <div class="my-2 d-flex justify-content-evenly">
                            <a class="btn btn-warning" href="altas/clientes.php?id=<?= $cliente['id'] ?>"><i class="far fa-edit"></i></a>
                            <a class="btn btn-danger" href="php/eliminar.php?cliente=<?= $cliente['id'] ?>"><i class="far fa-trash-alt text-black"></i></a>
                        </div>
                    </td>
                    <td class="align-middle">
                        <?= $cliente['nombre'] . ' ' . $cliente['apellido'] ?>
                    </td>
                    <td class="align-middle">
                        <?= $cliente['rfc'] ?>
                    </td>
                    <td class="align-middle text-center">
                        <i class="fas <?= $cliente['credito'] == 1 ? 'fa-check' : 'fa-times' ?> " style="font-size: larger;"></i>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>

<?php
    include 'res/layout/divs.html';
else :
    include 'res/layout/tira.html'
?>
    <div class="container">
        <h2 class="text-center">Acceso denegado</h2>
    </div>
<?php
endif;
include 'res/layout/scripts.html';
if (isset($_GET['modificado'])) {
    include 'res/db/alertasDB.php';
    $alertasdb = new AlertasDB();
    if ($_GET['modificado'] == 1) {
        $alertasdb->nuevaAlertaIcono('success', 'Cliente modificado', 'Se actualizaron los datos satisfactoriamente');
    } else {
        $alertasdb->nuevaAlertaIcono('error', 'Oops! Ocurrió un error', 'No fue posible actualizar los datos');
    }
}
include 'res/layout/cierre.html';
?>