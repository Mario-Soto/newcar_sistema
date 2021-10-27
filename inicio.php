<?php
session_start();
include 'res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include 'res/layout/nav.php';
    include 'res/layout/header.html';
?>
    <h2>Hola, <?= $_SESSION['usuario']['nombre'] ?></h2>
    <div class="container">
        <p>Revisa nuestro manual de usuario para conocer el funcionamiento de este sistema</p>
        <iframe src="https://docs.google.com/viewer?srcid=18msfhdvlBb1uQK0Q9okZdT9Xk02Vi55o&pid=explorer&efh=false&a=v&chrome=false&embedded=true" width="100%" height="620px"></iframe>
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