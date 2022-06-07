<?php

class Crud {

    protected const TABLAS = [];
    protected $name;
    protected $table;
    protected $columns;

    public function __construct ($name = '', $table = '', $columns = []) 
    {
        $this->name = $name;
        $this->table = $table;
        foreach ($columns as $column)
            $this->columns[] = $column;

    }

    public function getTable ()
    {
        return $this->table;
    }

    public function getColumns ()
    {
        return $this->columns;
    }

    public function pintar ()
    {
        if (empty($this->table))
            return false;

        $db = new ConnectorSQL;
        $conn = $db->getCon();

        if (empty($this->columns)) 
            $selection = '*';
        else
            $selection = implode(', ', $this->columns);

        $query = "DESCRIBE $this->table";
        $result = mysqli_query($conn, $query);
        
        
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
                                    if (empty($this->columns)) {
                                        while($value = $result->fetch_array(MYSQLI_ASSOC)){
                                            echo "<th class='text-center'>".$value['Field']."</th>";       
                                        }   
                                    }else foreach($this->columns as $column)
                                        echo "<th class='text-center'>".$column."</th>";  
                                        
                                    ?>
                                </tr>
                            </thead>
                            <tbody>

                                    <?php
                                        $query = "SELECT $selection from $this->table";
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