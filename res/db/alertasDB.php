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

    public function nuevaAlertaImagen($titulo, $texto, $imagen, $alt){
        print<<<"SCRIPT"
        <script>
            Swal.fire({
                title: '$titulo',
                html: '$texto',
                imageUrl: 'res/upload/autos/$imagen',
                imageWidth: 400,
                imageAlt: '$alt'
            })
        </script>
        SCRIPT;
    }
}

?>