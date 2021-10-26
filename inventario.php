<?php
session_start();
include 'res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include 'res/layout/nav.php';
    include 'res/layout/header.html';
    include 'res/db/autosDB.php';
    $autosdb = new AutosDB();
    if (isset($_GET['buscar'])) {
        $autos = $autosdb->buscaAutos($_GET['buscar']);
    } else if (isset($_GET['id'])) {
        $auto_id = $autosdb->getAutoPorId($_GET['id']);
        $autos = $autosdb->getAutos();
    } else {
        $autos = $autosdb->getAutos();
    }
?>
    <h1 class="text-center">Inventario</h1>
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
    <div class="row">
        <?php
        $i = 0;
        foreach ($autos as $auto) :
            $i++;
        ?>
            <div class="col-12 col-lg-6 my-2 d-flex">
                <div class="row col-12 bg-c1<?= $i % 2 == 0 ? '_3' : null ?> rounded">
                    <div class="col-5 p-0 d-flex align-content-center bg-light border">
                        <?php if ($auto['fotografia'] <> null) : ?>
                            <div class="align-self-center">
                                <img src="res/upload/autos/<?= $auto['fotografia'] ?>" alt="Fotografía <?= $auto['marca'] . ' ' . $auto['modelo'] . ' (' . $auto['año'] . ')' ?>" class="w-100 img-thumbnail rounded">
                            </div>
                        <?php else : ?>
                            <div class="rounded img-thumbnail w-100 bg-g h-100 text-center">Imagen no disponible</div>
                        <?php endif; ?>
                    </div>
                    <div class="col-7">
                        <h4 class="text-center pt-2"><?= $auto['marca'] . ' ' . $auto['modelo'] ?></h4>
                        <h6 class="text-center mx-auto">(<?= $auto['año'] ?>)</h6>
                        <div>
                            <span class="d-block">Transmision: <span class="text-decoration-underline px-1"><?= $auto['transmision'] ?></span></span>
                            <span class="d-block">Color: <span class="text-decoration-underline px-1"><?= $auto['color'] ?></span></span>
                            <span class="d-block">Estado: <span class="text-decoration-underline px-1"><?= $auto['estado'] == 1 ? 'Usado (' . $auto['kilometraje'] . ' km)' : 'Nuevo' ?></span></span>
                            <span class="d-block">Precio: <span class="text-decoration-underline px-1">$<?= $auto['precio'] ?></span></span>
                            <div class="my-2 d-flex justify-content-evenly">
                                <a class="btn btn-warning" href="altas/autos.php?id=<?= $auto['id'] ?>"><i class="far fa-edit"></i></a>
                                <a class="btn btn-danger" href="php/eliminar.php?auto=<?= $auto['id'] ?>"><i class="far fa-trash-alt text-black"></i></a>
                            </div>
                            <div class="text-center mb-2">
                                <a class="btn btn-success" href="ventas/realizar.php?id=<?= $auto['id'] ?>"><i class="fas fa-shopping-cart"></i> COMPRAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

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
if (isset($_GET['id'])) {
    include 'res/db/alertasDB.php';
    $alertasdb = new AlertasDB();
    $titulo = $auto_id['marca'] . ' ' . $auto_id['modelo'] . ' (' . $auto_id['año'] . ')';
    $texto = 'Precio: $<span class="solo-num">' . $auto_id['precio'] . "</span><br>Transmisión: " . $auto_id['transmision'] . "<br>";
    $alertasdb->nuevaAlertaImagen($titulo, $texto, $auto_id['fotografia'], 'Producto ' . $auto_id['id']);
}
if (isset($_GET['modificado'])) {
    include 'res/db/alertasDB.php';
    $alertasdb = new AlertasDB();
    $alertasdb->nuevaAlertaIcono('success', 'Auto modificado', 'Se actualizaron los datos satisfactoriamente');
}
include 'res/layout/cierre.html';
?>