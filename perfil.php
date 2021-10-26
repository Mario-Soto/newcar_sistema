<?php
session_start();
include 'res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include 'res/layout/nav.php';
    include 'res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/inserta_usuario.php" method="post" class="row bg-g p-3" enctype="multipart/form-data">
            <legend class="mx-auto text-center mb-0">
                <h2>Perfil de <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'] ?></h2>
            </legend>
            <div class="row">
                <div class="col-12 text-center">
                    <?php if ($_SESSION['usuario']['fotografia'] <> null) : ?>
                        <img src="res/upload/users/<?= $_SESSION['usuario']['fotografia'] ?>" alt="Fotografía <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'] ?>" max-width="200px" class="w-100 img-thumbnail rounded">
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="row mt-3">
                    <label for="nombre" class="col-form-label col-sm-3 col-form-label-sm">Nombre</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre" id="nombre" class="form-control-plaintext text-white" value="<?= $_SESSION['usuario']['nombre'] ?>" required readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="apellido" class="col-form-label col-sm-3 col-form-label-sm">Apellido</label>
                    <div class="col-sm-9">
                        <input type="text" name="apellido" id="apellido" class="form-control-plaintext text-white" value="<?= $_SESSION['usuario']['apellido'] ?>" required readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row mt-3">
                    <label for="usuario" class="col-form-label col-sm-3 col-form-label-sm">Usuario</label>
                    <div class="col-sm-9">
                        <input type="text" name="usuario" id="usuario" class="form-control-plaintext text-white" value="<?= $_SESSION['usuario']['usuario']  ?>" required readonly>
                    </div>
                </div>
                <!-- TODO: PONER D-NONE -->
                <div id="fotos" class="row mt-3 ">
                    <label for="fotografia" class="col-form-label col-sm-3 col-form-label-sm">Fotografía</label>
                    <div class="col-sm-9">
                        <input type="file" name="fotografia" id="fotografia" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-10 col-xl-8 text-center mx-auto">
                    <input type="button" id="editar_info" value="Editar información" class="btn btn-conf col-12 col-lg-10">
                </div>
            </div>
            <div id="botones" class="row mt-5">
                <div class="col-6 text-center">
                    <input type="reset" value="Limpiar" class="btn btn-limpiar col-12 col-lg-10">
                </div>
                <div class="col-6 text-center">
                    <input type="submit" value="Guardar" class="btn btn-submit col-12 col-lg-10">
                </div>
            </div>
        </form>
        <form action="" method="post" class="bg-g px-3">
            <div class="row">
                <div class="col-10 col-xl-8 text-center mx-auto">
                    <input type="button" id="camb_pass" value="Cambiar contraseña" class="btn btn-conf col-12 col-lg-10">
                </div>
            </div>
            <div id="form_contr">
                <div class="row">
                    <div class="col-12 col-lg-6 mt-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <div class="input-group" id="mos_oc_pass">
                            <input type="password" name="contraseña" id="contraseña" class="form-control" <?= isset($usuario) ? null : 'required' ?>>
                            <span class="input-group-text"><i class="fas fa-eye-slash" role="button"></i></span>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-3">
                        <label for="contraseña2" class="form-label">Confirmar contraseña</label>
                        <div class="input-group" id="mos_oc_pass2">
                            <input type="password" name="contraseña2" id="contraseña2" class="form-control" <?= isset($usuario) ? null : 'required' ?>>
                            <span class="input-group-text"><i class="fas fa-eye-slash" role="button"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6 text-center">
                        <input type="reset" value="Limpiar" class="btn btn-limpiar col-12 col-lg-10">
                    </div>
                    <div class="col-6 text-center">
                        <input type="submit" id="registrar" value="Guardar" class="btn btn-submit col-12 col-lg-10">
                    </div>
                </div>
            </div>
        </form>
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
include 'res/layout/cierre.html';
?>