<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="/newcar/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="res/css/style.css">
    <title>New Car</title>
</head>

<body class="h-100 bg-g">
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <img id="logo-login" src="res/images/new_car-logo.png" width="35%" alt="Logo New Car" class="mx-auto">
            </div>
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 bg-c1 mx-auto mt-2">
                <form action="php/entrar.php" class="m-3" method="post">
                    <legend>
                        <h2 class="text-white text-center">BIENVENIDO</h2>
                    </legend>
                    <div class="col-12 col-md-8 mx-auto">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-8 mx-auto mt-2">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <div class="input-group" id="mos_oc_pass">
                            <input type="password" name="contraseña" id="contraseña" class="form-control" required>
                            <span class="input-group-text"><i class="fas fa-eye-slash" role="button"></i></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <input type="submit" value="Enviar" class="col-5 my-3 btn btn-sub mx-auto">
                    </div>
                    <div class="row mt-2 text-center mb-3">
                        <span><a href="php/recuperar-contraseña.php" class="link-blanco">¿Olvidaste tu contraseña?</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php
    include 'res/layout/scripts.html';
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 1) {
            include 'res/db/alertasDB.php';
            $alertasdb = new AlertasDB();
            $alertasdb->nuevaAlertaIcono('error', 'Datos incorrectos', 'El usuario o la contraseña son incorrectos');
        }
    }
    include 'res/layout/cierre.html';
    ?>