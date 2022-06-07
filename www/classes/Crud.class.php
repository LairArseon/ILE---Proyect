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
            'resource_url' => 'URL'
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
            'handover_date' => 'Fecha Entrega'
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

    public static function getNameTable ($name)
    {
        $idtab = array_search($name, self::NOMTABLASCLEAN);
        return self::NOMTABLAS[$idtab];
    }

    private function setQuery ($selection, $query)
    {
        $table = $this->table;
        if ($table == 'tGroup' && $_SESSION['role'] == 'student')
        {

            return "SELECT $selection from tGroup where group_member = {$_SESSION['id']}" ;
        }
        if ($table == 'tTask' && $_SESSION['role'] == 'student')
        {
            return "SELECT $selection from tTask where task_group_id in (SELECT group_id from tGroup where group_member = {$_SESSION['id']})" ;
        }
        return $query;
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
                                    <a href="#" class="btn btn-secondary"><i class="bi bi-plus-square-dotted"></i><span>Add New</span></a>				
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
                                                    <a href="#" class="settings centerico text-center" title="Settings" data-toggle="tooltip"><i class="bi bi-pencil-square"></i></a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="delete centerico text-center" title="Delete" data-toggle="tooltip"><i class="bi bi-trash"></i></a>
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