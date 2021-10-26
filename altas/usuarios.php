<?php
session_start();
include '../res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    if (isset($_GET['usuario'])) {
        include '../res/db/usuariosDB.php';
        $usuariosdb = new UsuariosDB();
        $usuario = $usuariosdb->getUsuario($_GET['usuario']);
    }
    include '../res/layout/nav.php';
    include '../res/layout/header.html';
?>
    <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto mb-5">
        <form action="php/inserta_usuario.php" method="post" class="row bg-g p-3" enctype="multipart/form-data">
            <legend class="mx-auto text-center mb-0">
                <h2><?= isset($usuario) ? 'ACTUALIZACIÓN DE USUARIO' : 'ALTA DE USUARIO' ?></h2>
            </legend>
            <?php if (isset($usuario)) : ?>
                <input type="hidden" name="id" value="<?=$usuario['id']?>">
            <?php endif; ?>
            <div class="row">
                <div class="col-12 col-lg-6 mt-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?= isset($usuario) ? $usuario['nombre'] : null; ?>" required>
                </div>
                <div class="col-12 col-lg-6 mt-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" value="<?= isset($usuario) ? $usuario['apellido'] : null; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 mt-3 mx-auto">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" value="<?= isset($usuario) ? $usuario['usuario'] : null; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 mt-3">
                    <label for="contraseña" class="form-label">Contraseña</label>
                    <div class="input-group" id="mos_oc_pass">
                        <input type="password" name="contraseña" id="contraseña" class="form-control" <?= isset($usuario)?null:'required' ?>>
                        <span class="input-group-text"><i class="fas fa-eye-slash" role="button"></i></span>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-3">
                    <label for="contraseña2" class="form-label">Confirmar contraseña</label>
                    <div class="input-group" id="mos_oc_pass2">
                        <input type="password" name="contraseña2" id="contraseña2" class="form-control" <?= isset($usuario)?null:'required' ?>>
                        <span class="input-group-text"><i class="fas fa-eye-slash" role="button"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-12 <?= isset($usuario) ? null : 'col-lg-6' ?> mt-3">
                <label for="fotografia" class="form-label">Fotografía</label>
                <?php
                if (isset($usuario)) :
                ?>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <?php if ($usuario['fotografia'] <> null) : ?>
                                <img src="res/upload/users/<?= $usuario['fotografia'] ?>" alt="Fotografía <?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?>" max-width="200px" class="w-100 img-thumbnail rounded">
                            <?php else : ?>
                                <div class="rounded img-thumbnail bg-g text-center py-5" width="250px">Fotografía no disponible</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-6">
                        <?php
                    endif;
                        ?>
                        <input type="file" name="fotografia" id="fotografia" class="form-control <?= isset($usuario) ? 'mt-3' : null ?>" accept="image/*">
                        <?php
                        if (isset($usuario)) :
                        ?>
                        </div>
                    </div>
                <?php
                        endif;
                ?>
            </div>
            <div class="col-12 <?= isset($usuario) ? null : 'col-lg-6' ?> mt-3">
                <label for="rol" class="form-label">Rol</label>
                <select name="rol" id="rol" class="form-select">
                    <option <?= isset($usuario) ? null : 'selected'; ?>>Seleccione...</option>
                    <?php
                    include '../res/db/catalogosDB.php';
                    $catalogosdb = new CatalogosDB();
                    $roles = $catalogosdb->getRoles();
                    foreach ($roles as $rol) :
                    ?>
                        <option value="<?= $rol['id'] ?>" <?= isset($usuario) ? ($usuario['idRol'] == $rol['id'] ? 'selected' : null) : null; ?>><?= $rol['rol'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row mt-4">
                <div class="col-6 text-center">
                    <input type="reset" value="Limpiar" class="btn btn-limpiar col-12 col-lg-10">
                </div>
                <div class="col-6 text-center">
                    <input type="submit" id="registrar" value="Guardar" class="btn btn-submit col-12 col-lg-10">
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