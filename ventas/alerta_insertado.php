<?php
if(isset($_GET)){
    include '../res/db/alertasDB.php';
    $alertasdb = new AlertasDB();
    if(isset($_GET['insertado'])){
        $alertasdb->nuevaAlertaIcono('success','Venta realizada', 'Se realizó la venta de manera satisfactoria');
    }else if(isset($_GET['error'])){
        $alertasdb->nuevaAlertaIcono('error','Error al vender', 'La placa ya se encuentra registrada');
    }
}
