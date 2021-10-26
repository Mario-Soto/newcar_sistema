<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
    include '../res/db/ventasDB.php';
    $ventasdb = new VentasDB();
    if (isset($_GET['buscar'])) {
        $ventas = $ventasdb->buscaVenta($_GET['buscar']);
    } else {
        $ventas = $ventasdb->getVentas();
    }
?>
    <h1 class="text-center">Ventas</h1>
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
                <th>Cliente</th>
                <th>Auto</th>
                <th>Forma de pago</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($ventas as $venta) :
            ?>
                <tr>
                    <td>
                        <div class="my-2 d-flex justify-content-evenly">
                            <a class="btn btn-warning" href="ventas/realizar.php?id=<?= $venta['id'] ?>"><i class="far fa-edit"></i></a>
                            <a class="btn btn-danger" href="php/eliminar.php?venta=<?= $venta['id'] ?>"><i class="far fa-trash-alt text-black"></i></a>
                        </div>
                    </td>
                    <td class="align-middle">
                        <?= $venta['nombre'] . ' ' . $venta['apellido'] ?>
                    </td>
                    <td class="align-middle">
                        <?= $venta['marca'] . ' ' . $venta['modelo'] . ' (' . $venta['año'] . ')' ?>
                    </td>
                    <td class="align-middle">
                        <?= $venta['formaPago'] == 1 ? 'Efectivo' : 'Crédito' ?>
                    </td>
                    <td class="align-middle">
                        <span class="solo-num"><?= $venta['total'] ?></span>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>

<?php
    include '../res/layout/divs.html';
else :
    include '../res/layout/tira.html'
?>
    <div class="container">
        <h2 class="text-center">Acceso denegado</h2>
    </div>
<?php
endif;
include '../res/layout/scripts.html';
if (isset($_GET['modificado'])) {
    include '../res/db/alertasDB.php';
    $alertasdb = new AlertasDB();
    if ($_GET['modificado'] == 1) {
        $alertasdb->nuevaAlertaIcono('success', 'Venta modificado', 'Se actualizaron los datos satisfactoriamente');
    } else {
        $alertasdb->nuevaAlertaIcono('error', 'Oops! Ocurrió un error', 'No fue posible actualizar los datos');
    }
}
include '../res/layout/cierre.html';
?>