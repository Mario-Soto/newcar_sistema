<?php
session_start();
include 'res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include 'res/layout/nav.php';
    include 'res/layout/header.html';
?>
<h2>Hola, <?=$_SESSION['usuario']['nombre']?></h2>

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