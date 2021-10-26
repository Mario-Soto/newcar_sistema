<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    if (isset($_GET['id'])) {
        include '../res/db/modelosDB.php';
        $modelosdb = new ModelosDB();
        $modelo = $modelosdb->getModeloPorId($_GET['id']);
    }
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/inserta_modelo.php" method="post" class="row bg-g p-3">
            <legend class="mx-auto text-center mb-0">
                <h2><?= isset($modelo) ? 'ACTUALIZACIÓN DE MODELO' : 'ALTA DE MODELO' ?></h2>
            </legend>
            <?php if (isset($modelo)) : ?>
                <input type="hidden" name="id" value="<?=$modelo['id']?>">
            <?php endif; ?>
            <div class="col-12 mt-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control" <?= isset($modelo) ? 'value="' . $modelo['modelo'] . '"' : null; ?> required>
            </div>
            <div class="col-6 mt-3">
                <label for="año" class="form-label">Año</label>
                <select name="año" id="año" class="form-select">
                    <option selected>Selecciona...</option>
                    <?php
                    for ($i = 2021; $i>=1950; $i--) :
                    ?>
                        <option value="<?= $i ?>" <?= isset($modelo) && $modelo['año'] == $i ? 'selected' : null ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-6 mt-3">
                <label for="transmision" class="form-label">Transmisión</label>
                <select name="transmision" id="transmision" class="form-select">
                    <option selected>Selecciona...</option>
                    <?php
                    include '../res/db/catalogosDB.php';
                    $catalogosdb = new CatalogosDB();
                    $transmisiones = $catalogosdb->getTransmisiones();
                    foreach ($transmisiones as $transmision) :
                    ?>
                        <option value="<?= $transmision['id'] ?>" <?= isset($modelo) && $modelo['transmision'] == $transmision['transmision'] ? 'selected' : null ?>><?= $transmision['transmision'] ?></option>
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