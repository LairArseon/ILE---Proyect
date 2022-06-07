
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <img src="../assets/img/ILE.png" width="190" height="120" class="img-fluid text-center" alt="ILE - Logo">
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="collapseNavbar">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link h3" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link h3" href="#">Información</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link h3" href="#" data-bs-toggle="collapse">Tarifas</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link h3" href="../profile.php">Bienvenido <?= $_SESSION['user']?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link h5 text-danger" href="../logout.php">Cerrar Session</a>
                </li>
            </ul>
        </div>
    </div>
</nav>