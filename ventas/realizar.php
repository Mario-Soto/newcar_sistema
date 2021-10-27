<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    if (isset($_GET['id'])) {
        include '../res/db/ventasDB.php';
        $ventasdb = new VentasDB();
        $venta = $ventasdb->getVentaPorId($_GET['id']);
    }
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/realiza_venta.php" method="post" class="row justify-content-center bg-g p-3">
            <legend class="mx-auto text-center mb-0">
                <h2>NUEVA VENTA</h2>
            </legend>
            <?php if (isset($venta)) : ?>
                <input type="hidden" name="id" value="<?= $venta['id'] ?>">
            <?php endif; ?>
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
                        <option value="<?= $auto['id'] ?>" <?= isset($venta)&&$venta['idAuto']==$auto['id']?'selected':null ?>><?= $auto['marca'] . ' ' . $auto['modelo'] . ' (' . $auto['año'] . ')' ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="costo" id="costo" class="form-select" hidden>
                    <option>Selecciona...</option>
                    <?php
                    foreach ($autos as $auto) :
                    ?>
                        <option value="<?= $auto['precio'] ?>" <?= isset($venta)&&$venta['precio']==$auto['precio']?'selected':null ?>></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 col-lg-6 mt-3 align-self-center">
                <label for="cliente" class="form-label">Cliente</label>
                <select name="cliente" id="cliente" class="form-select" required>
                    <option>Selecciona...</option>
                    <?php
                    include '../res/db/clientesDB.php';
                    $clientesdb = new ClientesDB();
                    $clientes = $clientesdb->getClientes();
                    foreach ($clientes as $cliente) :
                    ?>
                        <option value="<?= $cliente['id'] ?>" <?= isset($venta)&&$venta['idCliente']==$cliente['id']?'selected':null ?>><?= $cliente['apellido'] . ' ' . $cliente['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="credit" id="credit" hidden>
                    <option>Selecciona...</option>
                    <?php
                    foreach ($clientes as $cliente) :
                    ?>
                        <option value="<?= $cliente['credito'] ?>" ><?= $cliente['credito'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6 mt-3">
                <label for="forma_pago" class="form-label">Forma de pago</label>
                <select name="forma_pago" id="forma_pago" class="form-select" <?= isset($venta)?($venta['credito']==0?'disabled':null):'disabled' ?>>
                    <option value="1" <?= isset($venta)&&$venta['formaPago']==1?'selected':null ?>>Efectivo</option>
                    <option value="2" <?= isset($venta)&&$venta['formaPago']==2?'selected':null ?>>Crédito</option>
                </select>
                <div class="<?= isset($venta)&&$venta['formaPago']==1?'d-none':null ?>" id="plazos">
                    <label for="plazo" class="form-label mt-2">Plazo</label>
                    <select name="plazo" id="plazo" class="form-select">
                        <option></option>
                        <option value="12" <?= isset($venta)&&$venta['plazo']==12?'selected':null ?>>12 meses</option>
                        <option value="18" <?= isset($venta)&&$venta['plazo']==18?'selected':null ?>>18 meses</option>
                        <option value="24" <?= isset($venta)&&$venta['plazo']==24?'selected':null ?>>24 meses</option>
                    </select>
                </div>
            </div>
            <div class="col-6 mt-3 d-flex justify-content-center">
                <div class="form-check form-switch align-self-center">
                    <input type="checkbox" name="emplacar" id="emplacar" class="form-check-input form-check-1"  <?= isset($venta)&&$venta['placa']<>null?'checked':null ?>>
                    <label for="emplacar" class="form-check-label">¿Desea emplacar?</label>
                    <small class="d-block">(Costo extra de $5,000)</small>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="placas" class="form-label">Placas</label>
                <input type="text" name="placas" id="placas" class="form-control" readonly <?= isset($venta)&&$venta['placa']<>null?'value="'.$venta['placa'].'"':null ?>>
            </div>
            <div class="col-12 mt-3">
                <label for="precio" class="form-label">Precio</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="text" name="precio" id="precio" class="form-control solo-num" readonly <?= isset($venta)?'value="'.$venta['total'].'"':null ?>>
                    <span class="input-group-text">.00</span>
                </div>
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