<?php


class Sidebar {


    protected const TASKS = ['Tareas', 1];
    protected const PROFILE = ['Perfil', 2];
    protected const GROUPS = ['Grupos', 3];
    protected const STUDENTS = ['Estudiantes', 4];
    protected const HOS = ['Entregas', 5];
    protected const RESOURCES = ['Recursos', 6];
    protected const PROFS = ['Profesores', 7];

    protected $campos;
    protected $rol;

    public function __construct($rol)
    {
        $this->rol = $rol;

        switch ($rol) {
            case 'dev':
                $this->setCampos(['Perfil', 'Tareas', 'Grupos', 'Estudiantes', 'Entregas', 'Recursos', 'Profesores']);

                break;
            case 'teacher':
                $this->setCampos(['Perfil', 'Tareas', 'Grupos', 'Estudiantes', 'Entregas', 'Recursos']);

                break;
            case 'admin':
                $this->setCampos(['Perfil', 'Tareas', 'Grupos', 'Estudiantes', 'Entregas', 'Recursos', 'Profesores']);

                break;
            default:
                $this->setCampos(['Perfil', 'Tareas', 'Grupos']);

                break;
        }
    }

    public function setCampos($campos = [])
    {
        foreach ($campos as $campo){
            if (!in_array($campo, 
            [self::TASKS[0], self::PROFILE[0], self::GROUPS[0], self::STUDENTS[0], self::HOS[0], self::RESOURCES[0], self::PROFS[0]])) 
                return false;
            else {
                $this->campos[] = $campo;
            }
        }
    }

    public function display() {

        ?>

            <div class="vertical-nav bg-white" id="sidebar">
            <div class="py-4 px-3 mb-4 bg-light">
                <div class="media d-flex align-items-center">
                    <img 
                        src="../assets/img/ILE - Small.png" 
                        alt="logo" 
                        width="120" 
                        class="mr-3 rounded-circle img-thumbnail shadow-sm home-ico"
                        onclick="window.location.assign('index.php')">
                <div class="media-body">
                    <h2 class="m-0">ILE</h2>
                    <p class="font-weight-light text-muted mb-0">Mi Area</p>
                </div>
                </div>
            </div>

            <?php

            foreach ($this->campos as $ncampo)
            {
                $ref = "display_crud.php?header=$ncampo";
                if ($ncampo == 'Perfil')
                    $ref = "profile.php";

                ?>
                <ul class="nav flex-column bg-white mb-0">
                    <li class="nav-item">
                    <a href=<?=$ref?> class="nav-link text-dark font-italic bg-light">
                                <span class="h2"><?= $ncampo ?></span> 
                            </a>
                    </li>

                <?php

            }

            ?>
                    <li class="nav-item mt-auto">
                    <a href="../logout.php" class="nav-link text-dark font-italic ">
                                <span class="text-danger h2">Cerrar Sesión</span> 
                            </a>
                    </li>
                </ul>
                </div>

                <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Menu</small></button>

            <?php
    }

}