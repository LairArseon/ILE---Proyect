<?php

class Crud {

    private const TABLAS = [
        'tUser' => [
            'user_id' => 'Id', 
            'user_name' => 'Nombre', 
            'user_last_name' => 'Apellido', 
            'user_mail' => 'Correo', 
            'user_address' => 'Direccion', 
            'user_phone' => 'Telefono',  
            'user_role' =>'Rol'
        ],
        'tTask' => [
            'task_id' => 'Id', 
            'task_group_id' => 'Id grupo', 
            'task_name' => 'Nombre Tarea', 
            'task_release_date' => 'Fecha creación', 
            'task_due_date' => 'Fecha límite'
        ],
        'tSubject' => [
            'subject_id' => 'Id',
            'subject_name' => 'Fecha límite',
            'subject_details' => 'Fecha límite'
        ],
        'tResource' => [
            'resource_id' => 'Id',
            'resource_type' => 'Tipo',
            'resource_url' => 'URL',
            'resource_details' => 'Detalles'
        ],
        'tNotif' => [
            'notif_id' => 'Id',
            'notif_type' => 'Tipo',
            'notif_content' => 'Contenido'
        ],
        'tHandover' => [
            'handover_id' => 'Id',
            'handover_author_id' => 'Id Autor',
            'handover_task_id' => 'Id Tarea',
            'handover_date' => 'Fecha Entrega',
            'handover_mark' => 'Nota Tarea'
        ],
        'tGroup' => [
            'group_id' => 'Id Grupo',
            'group_subject_id' => 'Id Asignatura',
            'group_handle' => 'Id Profesor',
            'group_member' => 'Id Alumno'
        ]
    ];
    private const NOMTABLAS = ['tUser', 'tTask', 'tSubject', 'tResource', 'tNotif', 'tHandover', 'tGroup'];
    private const NOMTABLASCLEAN = ['Usuarios', 'Tareas', 'Asignaturas', 'Recursos', 'Notificaciones', 'Entregas', 'Grupos'];
    private const TABLAS_ID = [
        'tUser' => 'user_id',
        'tTask' => 'task_id', 
        'tSubject' => 'subject_id',
        'tResource' => 'resource_id',
        'tNotif' => 'notif_id',
        'tHandover' => 'handover_id',
        'tGroup' => 'group_id'
    ];
    protected $name;
    protected $table;
    protected $columnsClean;
    protected $columns;

    public function __construct ($name = '', $table = '') 
    {
        $this->name = $name;
        $this->table = $table;

        if (($table != '') && in_array($table, self::NOMTABLAS))
            $this->setColumns($table);

    }

    public function getTable ()
    {
        return $this->table;
    }

    public function getColumns ()
    {
        return $this->columns;
    }

    public function setColumns ()
    {       
        foreach(self::TABLAS[$this->table] as $name => $nameclean)
        {
            $this->columnsClean[] = $nameclean;
            $this->columns[] = $name;
        }

    }

    public static function dropElement ($tabla, $id) 
    {
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "DELETE FROM $tabla WHERE ".self::TABLAS_ID[$tabla]."='$id';";
        if ($result = mysqli_query($conn, $query))
            return true;
        else
            return false;
    }

    public static function getNameTable ($name)
    {
        $idtab = array_search($name, self::NOMTABLASCLEAN);
        return self::NOMTABLAS[$idtab];
    }

    private function setQuery ($selection, $query)
    {
        $table = $this->table;
        $name = $this->name;
        if ($table == 'tGroup' && $_SESSION['role'] == 'student')
        {

            return "SELECT $selection from tGroup where group_member = {$_SESSION['id']}" ;
        }
        if ($table == 'tTask' && $_SESSION['role'] == 'student')
        {
            return "SELECT $selection from tTask where task_group_id in (SELECT group_id from tGroup where group_member = {$_SESSION['id']})" ;
        }
        if ($name == 'Estudiantes')
        {
            return "SELECT $selection from tUser where user_role = 'student'" ;
        }
        if ($name == 'Profesores')
        {
            return "SELECT $selection from tUser where user_role = 'teacher'" ;
        }
        return $query;
    }

    protected function butNew ($nombre, $rol)
    {
        switch ($nombre) {
            case 'Tareas':
                if ($rol != 'student')
                   return ('<a href="create_task.php" class="btn btn-secondary"><i class="bi bi-plus-square-dotted"></i><span>Añadir Tarea</span></a>');				

                break;
            case 'Estudiantes':
                if ($rol != 'student')
                    return ('<a href="create_user.php" class="btn btn-secondary"><i class="bi bi-plus-square-dotted"></i><span>Añadir Usuario</span></a>');				

                break;
            case 'Profesores':
                if ($rol != 'student')
                    return ('<a href="create_user.php" class="btn btn-secondary"><i class="bi bi-plus-square-dotted"></i><span>Añadir Usuario</span></a>');				

                break;
            
            default:
                return '';
                break;
        }
    }

    public function pintar ()
    {
        if (empty($this->table))
            return false;

        $db = new ConnectorSQL;
        $conn = $db->getCon();
        
        if (empty($this->columns))
            $selection = '*';
        $selection = implode(',', $this->columns);
        
        ?>
            <div class="container-xl">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h2><?= $this->name;?></b></h2>
                                </div>
                                <div class="col-sm-7">
                                    <?php  echo ($this->butNew($this->name, $_SESSION['role']));  ?>				
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <?php

                                        foreach($this->columnsClean as $columnclean)
                                            echo "<th class='text-center'>".$columnclean."</th>";  
                                        
                                    ?>
                                </tr>
                            </thead>
                            <tbody>

                                    <?php

                                        $query = "SELECT $selection from $this->table";
                                        $query = $this->setQuery($selection, $query);

                                        $result = mysqli_query($conn, $query);

                                        while($value = $result->fetch_array(MYSQLI_ASSOC)){
                                            echo '<tr>';
                                            foreach ($value as $campo)
                                                echo "<td class='text-center'>".$campo."</td>"; 
                                            
                                            ?>
                                                <td class="text-center">
                                                    <?php
                                                        switch ($this->table) {
                                                            case 'tTask':
                                                                ?>
                                                                <a href="display_task.php?id=<?= $value[self::TABLAS_ID[$this->table]] ?>" class="settings centerico text-center" title="Settings" data-toggle="tooltip"><i class="bi bi-pencil-square"></i></a>
                                                                <?php
                                                                break;

                                                            case 'tUser':
                                                                ?>
                                                                <a href="edit_profile.php?id=<?= $value[self::TABLAS_ID[$this->table]] ?>" class="settings centerico text-center" title="Settings" data-toggle="tooltip"><i class="bi bi-pencil-square"></i></a>
                                                                <?php
                                                                break;

                                                            case 'tHandover':
                                                                ?>
                                                                <a href="mark_task.php?id=<?= $value[self::TABLAS_ID[$this->table]] ?>" class="settings centerico text-center" title="Settings" data-toggle="tooltip"><i class="bi bi-pencil-square"></i></a>
                                                                <?php
                                                                break;
                                                            
                                                            default:
                                                                # code...
                                                                break;
                                                        }

                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                        if ($_SESSION['role'] != 'student') {
                                                    ?>
                                                        <a href="drop_element.php?tName=<?= $this->table ?>&elId=<?= $value[self::TABLAS_ID[$this->table]] ?>&header=<?=$_GET['header']?>" class="delete centerico text-center" id='delete' title="Delete" data-toggle="tooltip"><i class="bi bi-trash"></i></a>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                            <?php
                                            echo '</tr>';
                                        } 
                                    ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>     
        <?php
    }


}