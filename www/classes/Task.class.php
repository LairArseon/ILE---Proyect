<?php


class Task {

    private const TIPO_T = 'text';
    private const TIPO_A = 'audio';
    private const TIPO_V = 'video';
    private const TIPO_W = 'web';

    private $tipo = '';
    private $contenido = '';
    private $preguntas = [];

    public function __construct($tipo, $contenido, $preguntas)
    {
        $this->setContent($contenido);
        $this->setType($tipo);
        $this->setQuestions($preguntas);
    }

    public function setType ($tipo) {
        $this->tipo = $tipo;
    }

    public function setContent ($content) {
        $this->contenido = $content;
    }

    public function setQuestions ($questions) {
        foreach ($questions as $question)
            $this->preguntas[] = $question;
    }
    
    public function registerTask ($name, $duedate) {

        

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