<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/inserta_auto.php" method="post" class="row bg-g p-3">
            <legend class="mx-auto text-center mb-0">
                <h2>ALTAS DE MARCAS</h2>
            </legend>
            <div class="col-12 mt-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control" required>
            </div>
            <div class="col-12 mt-3">
                <label for="pais" class="form-label">País de origen</label>
                <select name="pais" id="pais" class="form-select">
                    <option selected>Selecciona...</option>
                    <?php
                    include '../res/db/catalogosDB.php';
                    $catalogosdb = new CatalogosDB();
                    $paises = $catalogosdb->getPaises();
                    foreach ($paises as $pais) :
                    ?>
                        <option value="<?= $pais['id'] ?>"><?= $pais['pais'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="row mt-4">
                <div class="col-6 text-center">
                    <input type="button" value="Limpiar" class="btn btn-limpiar col-12 col-lg-10">
                </div>
                <div class="col-6 text-center">
                    <input type="submit" value="Enviar" class="btn btn-submit col-12 col-lg-10">
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
include '../res/layout/cierre.html';
?>