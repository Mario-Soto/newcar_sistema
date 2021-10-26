<?php
if (isset($_GET)) {
    include '../res/db/alertasDB.php';
    $alertasdb = new AlertasDB();
    if (isset($_GET['insertado'])) {
        if ($_GET['insertado'] == 1) {
            $alertasdb->nuevaAlertaIcono('success', 'Registro añadido', 'Se insertó el registro satisfactoriamente');
        } else {
            $alertasdb->nuevaAlertaIcono('error', 'Oopss!', 'El registro no pudo ser añadido');
        }
    } else if (isset($_GET['error'])) {
        $alertasdb->nuevaAlertaIcono('error', 'Error al añadir', 'El usuario ya se encuentra en uso');
    }
}
