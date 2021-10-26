<div class="contenedor">
    <div id="fondo-nav">
        <nav id="nav" class="d-flex flex-column flex-shrink-0 sidebar">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                <img width="120px" src="res/images/new_car-logo.png" alt="Logo de NewCar">
                <span class="fs-5 fw-semibold ms-1">New Car</span>
            </a>
            <hr>
            <ul class="list-unstyled flex-column mb-auto">
                <li class="mb-1">
                    <a href="inicio.php" class="btn rounded collapsed">INICIO</a>
                </li>
                <li class="mb-1">
                    <a class="btn dropdown-toggle rounded collapsed" data-bs-toggle="collapse" data-bs-target="#altas" aria-expanded="false">
                        ALTAS
                    </a>
                    <div class="collapse" id="altas">
                        <ul class="sub-list list-unstyled fw-normal pb-1 small">
                            <?php
                            if ($_SESSION['usuario']['idRol'] == 2 || $_SESSION['usuario']['idRol'] == 1) :
                            ?>
                                <li><a href="altas/autos.php" class="rounded">Autos</a></li>
                                <li><a href="altas/marcas.php" class="rounded mt-1">Marcas</a></li>
                                <li><a href="altas/modelos.php" class="rounded mt-1">Modelos</a></li>
                            <?php
                            endif;
                            if ($_SESSION['usuario']['idRol'] == 3 || $_SESSION['usuario']['idRol'] == 1) :
                            ?>
                                <li><a href="altas/clientes.php" class="rounded mt-1">Clientes</a></li>
                            <?php
                            endif;
                            if ($_SESSION['usuario']['idRol'] == 1) : ?>
                                <li><a href="altas/usuarios.php" class="rounded mt-1">Usuarios</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <a class="btn dropdown-toggle rounded collapsed" data-bs-toggle="collapse" data-bs-target="#ventas" aria-expanded="false">
                        VENTAS
                    </a>
                    <div class="collapse" id="ventas">
                        <ul class="sub-list list-unstyled fw-normal pb-1 small">
                            <?php
                            if ($_SESSION['usuario']['idRol'] == 3 || $_SESSION['usuario']['idRol'] == 1) :
                            ?>
                                <li><a href="ventas/realizar.php" class="rounded">Nueva</a></li>
                            <?php
                            endif;
                            ?>
                            <li><a href="ventas/realizadas.php" class="rounded">Realizadas</a></li>
                        </ul>
                    </div>
                </li>
                <?php
                if ($_SESSION['usuario']['idRol'] == 1) : ?>
                    <li class="mb-1">
                        <a href="usuarios.php" class="btn rounded collapsed">USUARIOS</a>
                    </li>
                <?php endif; ?>
                <?php
                if ($_SESSION['usuario']['idRol'] == 3 || $_SESSION['usuario']['idRol'] == 1) :
                ?>
                    <li class="mb-1">
                        <a href="clientes.php" class="btn rounded collapsed">CLIENTES</a>
                    </li>
                <?php
                endif;
                ?>
                <li class="mb-1">
                    <a href="marcas.php" class="btn rounded collapsed">MARCAS</a>
                </li>
                <li class="mb-1">
                    <a href="modelos.php" class="btn rounded collapsed">MODELOS</a>
                </li>
                <li class="mb-1">
                    <a href="inventario.php" class="btn rounded collapsed">INVENTARIO</a>
                </li>
                <li class="mb-1">
                    <a class="btn rounded collapsed">TICKETS</a>
                </li>
                <li class="mb-1">
                    <a href="https://newcarconcesionaria.azurewebsites.net/" target="_blank" class="btn rounded collapsed">SITIO WEB</a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="res/upload/users/<?= $_SESSION['usuario']['fotografia'] <> null ? $_SESSION['usuario']['fotografia'] : 'default.png'; ?>" alt="Imagen usuario" width="32" height="32" class="rounded-circle me-2">
                    <strong><?= $_SESSION['usuario']['usuario'] ?></strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Salir</a></li>
                </ul>
            </div>
        </nav>
    </div>