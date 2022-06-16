<?php


class Task {

    private const TIPO_T = 'text';
    private const TIPO_A = 'audio';
    private const TIPO_V = 'video';
    private const TIPO_W = 'web';

    private $tipo = '';
    private $contenido = '';
    private $preguntas = [];
    private $resid;

    public function __construct($id)
    {
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT task_content, task_questions from tTask where task_id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($data = $result->fetch_array(MYSQLI_ASSOC))  
        {
            $this->setResId($data['task_content']);
            $this->setQuestions($data['task_questions']);
        }
            

        $query = "SELECT * from tResource where resource_id = '$this->resid'";
        $result = mysqli_query($conn, $query);

        if ($data = $result->fetch_array(MYSQLI_ASSOC))  
        {
            $this->setContent($data['resource_url']);
            $this->setType($data['resource_type']);
        }
    }

    private function setResId ($id) {
        $this->resid = $id;
    }

    public function setType ($tipo) {
        $this->tipo = $tipo;
    }

    public function setContent ($content) {
        $this->contenido = $content;
    }

    public function setQuestions ($questions) {

        $questionClean = json_decode($questions);

        foreach ($questionClean as $question)
            $this->preguntas[] = $question;
    }
    
    public static function registerTask ($name, $duedate, $group, $resourceid, $questions) {

        $db = new ConnectorSQL;
        $con = $db->getCon();

        // prepare and bind
        $stmt = $con->prepare("INSERT INTO tTask (task_group_id, task_name, task_release_date, task_due_date, task_content, task_questions) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssis", $group, $name, $currdate, $duedate, $resourceid, $questions);
        $currdate = date("Y/m/d");
        if ($stmt->execute())
            return true;
        else
            return false;

    }

    public static function registerHandover ($authorID, $taskID, $content)
    {
        $db = new ConnectorSQL;
        $con = $db->getCon();

        // prepare and bind
        $stmt = $con->prepare("INSERT INTO tHandover (handover_author_id, handover_task_id, handover_date, handover_content) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $authorID, $taskID, $currdate, $content);
        $currdate = date("Y/m/d");
        if ($stmt->execute())
            return true;
        else
            return false;
    }

    public static function listResources () {

        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT * from tResource";
        $result = mysqli_query($conn, $query);

        if ($rows = $result->fetch_all(MYSQLI_ASSOC))  
        {
            return $rows;
        }

    }

    public static function updateHandover ($id, $nota) {

        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "UPDATE tHandover SET handover_mark = '$nota' where handover_id = $id";
        if ($result = mysqli_query($conn, $query))
            return true;
        else 
            return false;
    }

    public static function creationForm () {

        ?>

        <!-- Section: Design Block -->
        <section class="container-sm text-center text-lg-start login-container">
        <form action="submit_task.php" method="POST">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 mt-4">

                    <h2>Recurso</h2>
                    <select name="resource" id="resource" class="form-select" required>
                        <option value="" selected>Selecciona un recurso</option>
                        <?php
                            $recursos = Task::listResources();
                            foreach ($recursos as $recurso)
                                echo "<option value='{$recurso['resource_id']}'>{$recurso['resource_details']}</option>";
                        ?>
                    </select>

                    <h2>Grupo</h2>
                    <select name="group" id="group" class="form-select" required>
                        <option value="" selected>Selecciona un grupo</option>
                        <?php
                            $recursos = User::listGroups();
                            foreach ($recursos as $recurso)
                                echo "<option value='{$recurso['group_id']}'>{$recurso['group_id']}</option>";
                        ?>
                    </select>
                    <hr>
                    <h2>Título</h2>
                    <input type="text" name="title" class="form-control" required/><br>
                    <hr>
                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <label for="date" class="col-md-5 col-form-label">Fecha límite</label>
                            <div class="input-group date" id="datepicker">
                                <input type="date" name="dueDate" class="form-control" id="date" required/>
                                <span class="input-group-append">
                                    <span class="input-group-text bg-light d-block">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary col-md-3">Crear Tarea</button>
                    </div>

                    <hr>

                    <h2>Preguntas</h2><br>

                    <div class="form-outline mb-4 questions">
                        
                    </div>

                    <button type="button" class="btn btn-primary col-md-3 add"><i class="bi bi-plus-circle"></i>Añadir pregunta</button>


                </div>
            </div>
        </form>
        </section>
        <!-- Section: Design Block -->

        <?php

    }

    public static function supervisorForm ($id) {

        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT * from tHandover where handover_id = '$id'";
        $result = mysqli_query($conn, $query);

        $entrega = $result->fetch_array(MYSQLI_ASSOC); 

        $query = "SELECT task_name from tTask where task_id = $entrega[handover_task_id]";
        $result = mysqli_query($conn, $query);

        $nomTarea = $result->fetch_array(MYSQLI_ASSOC);

        $query = "SELECT user_name from tUser where user_id = $entrega[handover_author_id]";
        $result = mysqli_query($conn, $query);

        $nomUser = $result->fetch_array(MYSQLI_ASSOC);

        ?>

        <!-- Section: Design Block -->
        <section class="container-sm text-center text-lg-start login-container">
        <form action="handin_handover.php" method="POST">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 mt-4">

                    <h2>Soluciones</h2>
                    <div class="row d-flex justify-content-center">
                        <div class="input-group mb-3 col-md-4">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?=$_GET['id']?>">
                            <span class="input-group-text" id="addonTarea" style="background-color:#a8c5e3;">Nombre de la Tarea</span>
                            <input type="text" class="form-control" aria-label="Tarea" aria-describedby="addonTarea" value="<?=$nomTarea['task_name']?>" disabled>
                            <span class="input-group-text" id="addonAlumno"  style="background-color:#a8c5e3;">Autor</span>
                            <input type="text" class="form-control" aria-label="Tarea" aria-describedby="addonAlumno" value="<?=$nomUser['user_name']?>" disabled>
                        </div>
                    </div>
                    <h2>Solución</h2>
                    <?php

                    $preres = explode('/', $entrega['handover_content']);
                    foreach ($preres as $conjunto)
                        $preresdeco[] = json_decode($conjunto);
                    
                    $nPreguntas = count($preresdeco[0]);
                    for ($i=0; $i < $nPreguntas; $i++) { 

                        ?>

                        <div class="col-md form-group text-left mb-4">
                            <label for="pregunta-<?=$i?>" class="mb-2">-- <?= $preresdeco[0][$i]; ?></label>
                            <input type="text" class="form-control" value="<?=$preresdeco[1][$i]?>">
                            <input type="checkbox" class="form-check-input h4" name="valor<?=$i?>">

                        </div>

                        <?php              
                    }
                    ?>
                    <input type="hidden" class="form-control" value="<?=$nPreguntas?>" name="nPreguntas">
                    <button type="submit" class="btn btn-primary col-md-3 add"><i class="bi bi-file-check"></i>  Añadir Corrección</button>


                </div>
            </div>
        </form>
        </section>
        <!-- Section: Design Block -->

        <?php
         
    }

    public function display (){

        if (!in_array($this->tipo, [self::TIPO_T, self::TIPO_A, self::TIPO_V, self::TIPO_W])) 
            return false;

        switch ($this->tipo) {
            case self::TIPO_T:
                
                ?>
                    

                <div class="container text-center">
                <h1 class="text-center mt-5"> TEXT </h1>
                <!-- Recurso -->
                <hr>
                <div class="card">
                    <div class="card-body text-justify"><?= $this->contenido;?></div>
                </div>
                <hr>
                <!-- Recurso -->
                <br><br><br>

                <?php

                break;
            case self::TIPO_A:
                
                ?>             

                <div class="container text-center">
                <h1 class="text-center mt-5"> AUDIO </h1>
                <!-- Recurso -->
                <hr>
                <audio controls>
                    <source src="<?= $this->contenido;?>"/>
                </audio>
                <hr>
                <!-- Recurso -->
                <br><br><br>

            <?php

                break;
            case self::TIPO_V:
                  
                ?>
                    
                    <div class="container text-center">
                    <h1 class="text-center mt-5"> VIDEO </h1>
                    <!-- Recurso -->
                    <hr>
                        <iframe width="889" height="500" 
                        src="<?= $this->contenido;?>" 
                        title="YouTube video player" frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>
                    <hr>
                    <!-- Recurso -->
                    <br><br><br>

                    <?php

                break;
            default:

                ?>
                    <div class="container text-center">
                    <h1 class="text-center mt-5"> WEB </h1>
                    <!-- Recurso -->
                    <hr>
                        <a href="<?= $this->contenido;?>" target="_blank">Recurso Web</a>
                    <hr>
                    <!-- Recurso -->
                    <br><br><br>
 
                    <?php

                break;

        }
        // Preguntas ________________________________________________________________________
                    $iter = 0;

                    ?>
                        <form action="handin_task.php" method='POST'>
                    <?php
                
                    foreach($this->preguntas as $pregunta)
                    {
                ?>
                        <div class="row text-center">
    
                            <div class="col-md form-group text-center mb-4">
                                <label for="pregunta-<?=$iter?>" class="mb-2"><?=$pregunta?></label>
                                <input type="hidden" class="form-control" id="pregunta-<?=$iter?>" name="pregunta-<?=$iter?>" value="<?=$pregunta?>">
                                <input type="text" class="form-control" id="respuesta-<?=$iter?>" name="respuesta-<?=$iter?>">
                            </div>
                        </div>
                <?php
                    $iter++;
                    }
                    ?>
                    <div class="row justify-content-around">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?=$_GET['id']?>">
                        <button type='button' class='btn btn-secondary col-md-2' onclick="history.back()">Atras</button>
                        <button type='submit' class='btn btn-primary col-md-2'>Submit</button>
                    </div>
                    </form>
                    </div>
            <?php

    }

}