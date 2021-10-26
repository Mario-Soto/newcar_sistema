<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    if (isset($_GET['id'])) {
        include '../res/db/autosDB.php';
        $autosdb = new AutosDB();
        $auto = $autosdb->getAutoPorId($_GET['id']);
    }
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/inserta_auto.php" method="post" class="row bg-g p-3" enctype="multipart/form-data">
            <legend class="mx-auto text-center mb-0">
                <h2> <?= isset($auto) ? 'ACTUALIZACIÓN DE AUTO' : 'ALTA DE AUTO'; ?></h2>
            </legend>
            <?php if (isset($auto)) : ?>
                <input type="hidden" name="id" value="<?=$auto['id']?>">
            <?php endif; ?>
            <div class="col-12 col-lg-6 mt-3">
                <label for="marca" class="form-label">Marca</label>
                <select name="marca" id="marca" class="form-select" required>
                    <option>Selecciona...</option>
                    <?php
                    include '../res/db/marcasDB.php';
                    $marcasdb = new MarcasDB();
                    $marcas = $marcasdb->getMarcas();
                    foreach ($marcas as $marca) :
                    ?>
                        <option value="<?= $marca['id'] ?>" <?= isset($auto) && $marca['marca'] == $auto['marca'] ? 'selected' : null; ?>><?= $marca['marca'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="color" class="form-label">Color</label>
                <select name="color" id="color" class="form-select" required>
                    <option>Selecciona...</option>
                    <?php
                    include '../res/db/catalogosDB.php';
                    $catalogosdb = new CatalogosDB();
                    $colores = $catalogosdb->getColores();
                    foreach ($colores as $color) :
                    ?>
                        <option value="<?= $color['id'] ?>" <?= isset($auto) && $color['color'] == $auto['color'] ? 'selected' : null; ?>><?= $color['color'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 mt-3">
                <label for="modelo" class="form-label">Modelo</label>
                <select name="modelo" id="modelo" class="form-select" required>
                    <option>Selecciona...</option>
                    <?php
                    include '../res/db/modelosDB.php';
                    $modelosdb = new ModelosDB();
                    $modelos = $modelosdb->getModelos();
                    foreach ($modelos as $modelo) :
                    ?>
                        <option value="<?= $modelo['id'] ?>" <?= isset($auto) && $modelo['modelo'] == $auto['modelo'] ? 'selected' : null; ?>><?= $modelo['modelo'] . ' (' . $modelo['año'] . ')' . ' - ' . $modelo['transmision'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6 mt-3">
                <label for="estado" class="form-label">Estado</label>
                <div class="w-100">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="estado" id="nuevo" class="form-check-input" value="0" <?= isset($auto) ? ($auto['estado'] == 0 ? 'checked' : null) : 'checked'; ?>>
                        <label for="nuevo" class="form-check-label">Nuevo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="estado" id="usado" class="form-check-input" value="1" <?= isset($auto) ? ($auto['estado'] == 1 ? 'checked' : null) : null; ?>>
                        <label for="usado" class="form-check-label">Usado</label>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-3">
                <label for="kilometraje" class="form-label">Kilometraje</label>
                <input type="text" name="kilometraje" id="kilometraje" class="form-control solo-num" placeholder="2,500" <?= isset($auto) ? ($auto['estado'] == 0 ? 'disabled value="0"' : 'value="' . $auto['kilometraje'] . '"') : 'disabled' ?>>
            </div>
            <div class="col-12 mt-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control" <?= isset($auto) ? 'value="' . $auto['descripcion'] . '"' : null; ?>></textarea>
            </div>
            <div class="col-12 <?= isset($auto) ? null : 'col-lg-6' ?> mt-3">
                <label for="precio" class="form-label">Precio</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="text" name="precio" id="precio" class="form-control solo-num" placeholder="1,500,000" required <?= isset($auto) ? 'value="' . $auto['precio'] . '"' : null; ?>>
                    <span class="input-group-text">.00</span>
                </div>
            </div>
            <div class="col-12 <?= isset($auto) ? null : 'col-lg-6' ?> mt-3">
                <label for="fotografia" class="form-label">Fotografía</label>
                <?php
                if (isset($auto)) :
                ?>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <?php if ($auto['fotografia'] <> null) : ?>
                                <img src="res/upload/autos/<?= $auto['fotografia'] ?>" alt="Fotografía <?= $auto['marca'] . ' ' . $auto['modelo'] . ' (' . $auto['año'] . ')' ?>" max-width="200px" class="w-100 img-thumbnail rounded">
                            <?php else : ?>
                                <div class="rounded img-thumbnail bg-g text-center py-5" width="250px">Imagen no disponible</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-6">
                        <?php
                    endif;
                        ?>
                        <input type="file" name="fotografia" id="fotografia" class="form-control <?= isset($auto)?'mt-3':null?>" accept="image/*">
                        <?php
                        if (isset($auto)) :
                        ?>
                        </div>
                    </div>
                <?php
                        endif;
                ?>

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