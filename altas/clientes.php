<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/inserta_cliente.php" method="post" class="row bg-g p-3">
            <legend class="mx-auto text-center mb-0">
                <h2>ALTAS DE CLIENTES</h2>
            </legend>
            <div class="col-12 col-lg-6 mt-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required>
            </div>
            <div class="col-6 mt-3">
                <label for="rfc" class="form-label">RFC</label>
                <input type="text" name="rfc" id="rfc" class="form-control" maxlength="13" required>
            </div>
            <div class="col-6 mt-3 d-flex justify-content-center">
                <div class="form-check form-switch align-self-center">
                    <input type="checkbox" name="credito" id="credito" class="form-check-input form-check-1" value="1">
                    <label for="credito" class="form-check-label">Crédito para financiamiento</label>
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