 <nav class="navbar navbar-inverse">
    <a class="navbar-brand"><?php echo $_SESSION['usuario'] ?></a>
        <ul class="nav navbar-nav">
            <li class="nav-item" id="navUsuarios">
                <a class="nav-link" href="ver_documentos.php">Ver Documentos</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="javascript://" onclick="cerrar_sesion()">Cerrar sesion <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </li>
        </ul>
</nav>