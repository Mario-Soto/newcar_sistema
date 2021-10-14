<?php
if(isset($_GET['insertado'])){
    if($_GET['insertado'] == 1){
        include '../res/db/alertasDB.php';
        $alertasdb = new AlertasDB();
        $alertasdb->nuevaAlertaIcono('success','Registro añadido', 'Se insertó el registro satisfactoriamente');
    }
}

?>