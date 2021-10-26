<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    if (isset($_GET['id'])) {
        include '../res/db/marcasDB.php';
        $marcasdb = new MarcasDB();
        $marca = $marcasdb->getMarcaPorId($_GET['id']);
    }
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/inserta_marca.php" method="post" class="row bg-g p-3">
            <legend class="mx-auto text-center mb-0">
                <h2><?= isset($marca) ? 'ACTUALIZACIÓN DE MARCA' : 'ALTA DE MARCA' ?></h2>
            </legend>
            <?php if (isset($marca)) : ?>
                <input type="hidden" name="id" value="<?=$marca['id']?>">
            <?php endif; ?>
            <div class="col-12 mt-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control" <?= isset($marca) ? 'value="' . $marca['marca'] . '"' : null; ?> required>
            </div>
            <div class="col-12 mt-3">
                <label for="pais" class="form-label">País de origen</label>
                <select name="pais" id="pais" class="form-select" required>
                    <option>Selecciona...</option>
                    <?php
                    include '../res/db/catalogosDB.php';
                    $catalogosdb = new CatalogosDB();
                    $paises = $catalogosdb->getPaises();
                    foreach ($paises as $pais) :
                    ?>
                        <option value="<?= $pais['id'] ?>" <?= isset($marca) && $marca['pais'] == $pais['id'] ? 'selected' : null ?>><?= $pais['pais'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="row mt-4">
                <div class="col-6 text-center">
                    <input type="reset" value="Limpiar" class="btn btn-limpiar col-12 col-lg-10">
                </div>
                <div class="col-6 text-center">
                    <input type="submit" value="Guardar" class="btn btn-submit col-12 col-lg-10">
                </div>
            </div>
        </form>
    </div>

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
include 'alerta_insertado.php';
include '../res/layout/cierre.html';
?>