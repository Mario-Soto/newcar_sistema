<?php

class AlertasDB {

    public function nuevaAlertaIcono($icono, $titulo, $texto){
        print<<<"SCRIPT"
        <script>
            Swal.fire({
                icon: '$icono',
                title: '$titulo',
                text: '$texto'
            })
        </script>
        SCRIPT;
    }

    public function nuevaAlerta($titulo, $texto){
        print<<<"SCRIPT"
        <script>
            Swal.fire({
                title: '$titulo',
                text: '$texto'
            })
        </script>
        SCRIPT;
    }

}

?>