<?php
session_start();
include 'res/layout/head.html';
if (isset($_SESSION['usuario'])) :
    include 'res/layout/nav.php';
    include 'res/layout/header.html';
    include 'res/db/autosDB.php';
    $autosdb = new AutosDB();
    if (isset($_GET['buscar'])) {
        $autos = $autosdb->buscaAutos($_GET['buscar']);
    } else if (isset($_GET['id'])) {
        $auto_id = $autosdb->getAutoPorId($_GET['id']);
        $autos = $autosdb->getAutos();
    } else {
        $autos = $autosdb->getAutos();
    }
?>
    <h1 class="text-center">Inventario</h1>
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
    <table class="table table-striped bg-c1 ">
        <tr>
            <th></th>
            <th>Auto</th>
            <th>Transmisión</th>
            <th class="d-none d-sm-table-cell">Color</th>
            <th>Estado</th>
            <th>Precio</th>
        </tr>
        <?php
        foreach ($autos as $auto) :
        ?>
        <tr>
            <td class="text-center"><a href="inventario.php?id=<?= $auto['id']?>"><i class="far fa-eye"></i></a></td>
            <td><?= $auto['marca'].' '.$auto['modelo'].' ('.$auto['año'].')'?></td>
            <td><?= $auto['transmision'] ?></td>
            <td class="d-none d-sm-table-cell"><?= $auto['color'] ?></td>
            <td><?= $auto['estado']==1?'Usado - '.$auto['kilometraje'].' kms':'Nuevo'?></td>
            <td>$ <span class="solo-num"><?= $auto['precio'] ?></span></td>
        </tr>
        <?php endforeach; ?>
    </table>


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
if(isset($_GET['id'])){
    include 'res/db/alertasDB.php';
    $alertasdb = new AlertasDB();
    $titulo = $auto_id['marca'].' '.$auto_id['modelo'].' ('.$auto_id['año'].')';
    $texto = 'Precio: $<span class="solo-num">'.$auto_id['precio']."</span><br>Transmisión: ".$auto_id['transmision']."<br>";
    $alertasdb->nuevaAlertaImagen($titulo,$texto,$auto_id['fotografia'],'Producto '.$auto_id['id']);
}
include 'res/layout/cierre.html';
?>