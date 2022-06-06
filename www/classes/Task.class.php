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
                
                $page = new Structure();
                ?>

                


                <?php


                break;
            case self::TIPO_A:
                
                
                ?>


                <?php


                break;
            case self::TIPO_V:
                
                
                ?>


                <?php


                break;
            default:


                ?>


                <?php


                break;
        }

    }

}