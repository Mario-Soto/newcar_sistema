<?php
if(isset($_GET)){
    include '../res/db/alertasDB.php';
    $alertasdb = new AlertasDB();
    if(isset($_GET['insertado'])){
        $alertasdb->nuevaAlertaIcono('success','Registro añadido', 'Se insertó el registro satisfactoriamente');
    }else if(isset($_GET['error'])){
        $alertasdb->nuevaAlertaIcono('error','Error al añadir', 'El usuario ya se encuentra en uso');
    }
}
