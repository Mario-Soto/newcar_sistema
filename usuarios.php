<?php
session_start();
include 'res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include 'res/layout/nav.php';
    include 'res/layout/header.html';
    include 'res/db/usuariosDB.php';
    $usuariosdb = new UsuariosDB();
    if (isset($_GET['buscar'])) {
        $usuarios = $usuariosdb->buscaUsuarios($_GET['buscar']);
    } else {
        $usuarios = $usuariosdb->getUsuarios();
    }
?>
    <h1 class="text-center">Usuarios</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get" class="row mb-4 mt-2">
        <div class="row justify-content-center">
            <div class="col-8 col-md-7 col-lg-6">
                <input type="search" name="buscar" id="buscar" placeholder="Realiza tu búsqueda" class="form-control" required>
            </div>
            <div class="col-1">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <div class="row">
        <?php
        $i = 0;
        foreach ($usuarios as $usuario) :
            $i++;
        ?>
            <div class="col-12 col-lg-6 my-2 d-flex">
                <div class="row col-12 bg-c1<?= $i % 2 == 0 ? '_3' : null ?> rounded">
                    <div class="col-5 p-0 d-flex align-content-center bg-light border">
                        <?php if ($usuario['fotografia'] <> null) : ?>
                            <div class="align-self-center">
                                <img src="res/upload/users/<?= $usuario['fotografia'] ?>" alt="Fotografía <?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?>" class="w-100 img-thumbnail rounded">
                            </div>
                        <?php else : ?>
                            <div class="rounded img-thumbnail w-100 bg-g h-100 text-center">Imagen no disponible</div>
                        <?php endif; ?>
                    </div>
                    <div class="col-7">
                        <h4 class="text-center mt-3"><?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?></h4>
                        <h6 class="text-center mx-usuario mt-2">(<?= $usuario['rol'] ?>)</h6>
                        <div class="my-3 d-flex justify-content-evenly">
                            <a class="btn btn-warning" href="altas/usuarios.php?usuario=<?= $usuario['usuario'] ?>"><i class="fas fa-user-edit"></i></a>
                            <a class="btn btn-danger" href="php/eliminar.php?usuario=<?= $usuario['usuario'] ?>"><i class="fas fa-user-minus text-black"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
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
if (isset($_GET['modificado'])) {
    include 'res/db/alertasDB.php';
    $alertasdb = new AlertasDB();
    if ($_GET['modificado'] == 1) {
        $alertasdb->nuevaAlertaIcono('success', 'Usuario modificado', 'Se actualizaron los datos satisfactoriamente');
    } else {
        $alertasdb->nuevaAlertaIcono('error', 'Oops! Ocurrió un error', 'No fue posible actualizar los datos');
    }
}
include 'res/layout/cierre.html';
?>