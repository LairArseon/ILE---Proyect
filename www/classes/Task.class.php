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
    
    public function registerTask ($name, $duedate) {

        //Do something

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
                    <hr>
                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <label for="date" class="col-md-5 col-form-label">Fecha límite</label>
                            <div class="input-group date" id="datepicker">
                                <input type="date" class="form-control" id="date"/>
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

                    <h2>Preguntas</h2>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                    <input type="email" id="form2Example1" name="email" class="form-control" />
                    <label class="form-label" for="form2Example1">Correo electrónico</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                    <input type="password" id="form2Example2" name="pass" class="form-control" />
                    <label class="form-label" for="form2Example2">Contraseña</label>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="remember" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="./forgot_pass.php">Forgot password?</a>
                    </div>
                    </div>

                    



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

                <form action="">
                
            <?php
    // Preguntas ________________________________________________________________________
                $iter = 0;
                foreach($this->preguntas as $pregunta)
                {
            ?>
                    <div class="row text-center">

                        <div class="col-md form-group text-center mb-4">
                            <label for="pregunta-<?=$iter?>" class="mb-2    "><?=$pregunta?></label>
                            <input type="text" class="form-control" id="respuesta-<?=$iter?>" placeholder="">
                        </div>
                    </div>
            <?php
                }
                ?>
                <div class="row justify-content-around">
                    <button type='button' class='btn btn-secondary col-md-2' onclick="history.back()">Atras</button>
                    <button type='submit' class='btn btn-primary col-md-2'>Submit</button>
                </div>
                </form>
                </div>
    
                <?php
    // Preguntas ________________________________________________________________________

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

                <form action="">
                
            <?php
    // Preguntas ________________________________________________________________________
                $iter = 0;
                foreach($this->preguntas as $pregunta)
                {
            ?>
                    <div class="row text-center mb-4">

                        <div class="col-md form-group text-center">
                            <label for="pregunta-<?=$iter?>" class="mb-2    "><?=$pregunta?></label>
                            <input type="text" class="form-control" id="respuesta-<?=$iter?>" placeholder="">
                        </div>
                    </div>
            <?php
                }
                ?>
                <div class="row justify-content-around">
                    <button type='button' class='btn btn-secondary col-md-2' onclick="history.back()">Atras</button>
                    <button type='submit' class='btn btn-primary col-md-2'>Submit</button>
                </div>
                </form>
                </div>
    
                <?php
    // Preguntas ________________________________________________________________________

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

                    <form action="">
                    
                <?php
        // Preguntas ________________________________________________________________________
                    $iter = 0;
                    foreach($this->preguntas as $pregunta)
                    {
                ?>
                        <div class="row text-center mb-4">

                            <div class="col-md form-group text-center">
                                <label for="pregunta-<?=$iter?>" class="mb-2    "><?=$pregunta?></label>
                                <input type="text" class="form-control" id="respuesta-<?=$iter?>" placeholder="">
                            </div>
                        </div>
                <?php
                    }
                    ?>
                    <div class="row justify-content-around">
                        <button type='button' class='btn btn-secondary col-md-2' onclick="history.back()">Atras</button>
                        <button type='submit' class='btn btn-primary col-md-2'>Submit</button>
                    </div>
                    </form>
                    </div>
        
                    <?php
        // Preguntas ________________________________________________________________________


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

                    <form action="">
                    
                <?php
        // Preguntas ________________________________________________________________________
                    $iter = 0;
                    foreach($this->preguntas as $pregunta)
                    {
                ?>
                        <div class="row text-center mb-4">

                            <div class="col-md form-group text-center">
                                <label for="pregunta-<?=$iter?>" class="mb-2    "><?=$pregunta?></label>
                                <input type="text" class="form-control" id="respuesta-<?=$iter?>" placeholder="">
                            </div>
                        </div>
                <?php
                    }
                    ?>
                    <div class="row justify-content-around">
                        <button type='button' class='btn btn-secondary col-md-2' onclick="history.back()">Atras</button>
                        <button type='submit' class='btn btn-primary col-md-2'>Submit</button>
                    </div>
                    </form>
                    </div>
        
                    <?php
        // Preguntas ________________________________________________________________________

                break;

        }

    }

}