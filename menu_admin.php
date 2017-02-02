<nav class="navbar navbar-inverse">
    <a class="navbar-brand"><?php echo $_SESSION['usuario'] ?></a>
        <ul class="nav navbar-nav">
            <li class="nav-item" id="navUsuarios">
                <a class="nav-link" href="usuarios.php">Usuarios</a>
            </li>
            <li class="nav-item" id="navArchivos">
                <a class="nav-link" href="archivos.php">Archivos</a>
            </li>
            <li class="nav-item" id="navConf">
                <a class="nav-link" href="bitacora.php">Historial de descarga</a>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li class="nav-item">
                <a class="nav-link" href="javascript://" onclick="cerrar_sesion()">Cerrar sesion <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </li>
        </ul>
</nav>