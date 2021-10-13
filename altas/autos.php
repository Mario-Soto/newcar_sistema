<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/inserta_auto.php" method="post" class="row bg-g p-3" enctype="multipart/form-data">
            <legend class="mx-auto text-center mb-0">
                <h2>ALTAS DE AUTOS</h2>
            </legend>
            <div class="col-12 col-lg-6 mt-3">
                <label for="marca" class="form-label">Marca</label>
                <select name="marca" id="marca" class="form-select">
                    <option selected>Selecciona...</option>
                    <?php
                    include '../res/db/marcasDB.php';
                    $marcasdb = new MarcasDB();
                    $marcas = $marcasdb->getMarcas();
                    foreach ($marcas as $marca) :
                    ?>
                        <option value="<?= $marca['id'] ?>"><?= $marca['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="color" class="form-label">Color</label>
                <select name="color" id="color" class="form-select">
                    <option selected>Selecciona...</option>
                    <?php
                    include '../res/db/catalogosDB.php';
                    $catalogosdb = new CatalogosDB();
                    $colores = $catalogosdb->getColores();
                    foreach ($colores as $color) :
                    ?>
                        <option value="<?= $color['id'] ?>"><?= $color['color'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 mt-3">
                <label for="modelo" class="form-label">Modelo</label>
                <select name="modelo" id="modelo" class="form-select">
                    <option selected>Selecciona...</option>
                    <?php
                    include '../res/db/modelosDB.php';
                    $modelosdb = new ModelosDB();
                    $modelos = $modelosdb->getModelos();
                    foreach ($modelos as $modelo) :
                    ?>
                        <option value="<?= $modelo['id'] ?>"><?= $modelo['nombre'] . '( ' . $modelo['año'] . ' )' . ' - ' . $modelo['transmision'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6 mt-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select">
                    <option selected>Selecciona...</option>
                    <option value="0">Nuevo</option>
                    <option value="1">Usado</option>
                </select>
            </div>
            <div class="col-6 mt-3">
                <label for="kilometraje" class="form-label">Kilometraje</label>
                <input type="text" name="kilometraje" id="kilometraje" class="form-control" placeholder="2500" disabled>
            </div>
            <div class="col-12 mt-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="precio" class="form-label">Precio</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="text" name="precio" id="precio" class="form-control" placeholder="1,500,000">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="fotografia" class="form-label">Fotografía</label>
                <input type="file" name="fotografia" id="fotografia" class="form-control" accept="image/*">
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