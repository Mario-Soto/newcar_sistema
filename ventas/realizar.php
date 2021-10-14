<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/realiza_venta.php" method="post" class="row justify-content-center bg-g p-3">
            <legend class="mx-auto text-center mb-0">
                <h2>NUEVA VENTA</h2>
            </legend>
            <div class="col-12 mt-3">
                <label for="auto" class="form-label">Auto</label>
                <select name="auto" id="auto" class="form-select" required>
                    <option>Selecciona...</option>
                    <?php
                    include '../res/db/autosDB.php';
                    $autosdb = new AutosDB();
                    $autos = $autosdb->getAutos();
                    foreach ($autos as $auto) :
                    ?>
                        <option value="<?= $auto['id'] ?>"><?= $auto['marca'] . ' ' . $auto['modelo'] . ' (' . $auto['año'] . ')' ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="costo" id="costo" class="form-select" hidden>
                    <option>Selecciona...</option>
                    <?php
                    foreach ($autos as $auto) :
                    ?>
                        <option value="<?= $auto['precio'] ?>"></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="cliente" class="form-label">Cliente</label>
                <select name="cliente" id="cliente" class="form-select" required>
                    <option>Selecciona...</option>
                    <?php
                    include '../res/db/clientesDB.php';
                    $clientesdb = new ClientesDB();
                    $clientes = $clientesdb->getClientes();
                    foreach ($clientes as $cliente) :
                    ?>
                        <option value="<?= $cliente['id'] ?>"><?= $cliente['apellido'] . ' ' . $cliente['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6 mt-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" max="25" value="1">
            </div>
            <div class="col-6 mt-3 d-flex justify-content-center">
                <div class="form-check form-switch align-self-center">
                    <input type="checkbox" name="emplacar" id="emplacar" class="form-check-input form-check-1">
                    <label for="emplacar" class="form-check-label">¿Desea emplacar?</label>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="placas" class="form-label">Placas</label>
                <input type="text" name="placas" id="placas" class="form-control" readonly>
            </div>
            <div class="col-12 mt-3">
                <label for="precio" class="form-label">Precio</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="text" name="precio" id="precio" class="form-control solo-num" readonly>
                    <span class="input-group-text">.00</span>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6 text-center">
                    <input type="reset" value="Limpiar" class="btn btn-limpiar col-12 col-lg-10">
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
include 'alerta_insertado.php';
include '../res/layout/cierre.html';
?>