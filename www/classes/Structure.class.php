<?php

class Structure {


    public function head ($page_name, $styles = []) 
    {
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $page_name ?></title>
            <!-- Favicon-->
            <link rel="icon" type="image/x-icon" href="assets/ile___small_GaT9qx.ico" />
            <!-- Bootstrap icons-->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <!-- Google fonts-->
            <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
            <!-- Core theme CSS (includes Bootstrap)-->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">  
            <?php 
            foreach ($styles as $style)
                echo "<link href='$style' rel='stylesheet' type='text/css' />";
            ?>
        </head>
        <body class="d-flex flex-column min-vh-100">

        <?php
    }

    public function paint_header_nl()
    {
        include_once './templates/ext-nav.template.php';
    }

    public function paint_header_l()
    {
        include_once './templates/ext-nav-logged.template.php';
    }

    public function paint_sidebar ($rol)
    {
        $sidebar = new Sidebar($rol);

        $sidebar->display();
    }

    public function profile_card ()
    {
        $name = $_SESSION['user'];
        $role = $_SESSION['role'];
        $mail = $_SESSION['mail'];
        $user = new User($name, $role);

        $user->display_profile($mail);

    }

    public function paint_crud ($name = '', $table = '')
    {

        $crud = new Crud($name, $table);
        $crud->pintar();

    }

    public function paint_footer ()
    {
        include_once './templates/footer.template.php';
    }

    public function paint_task ($id)
    {
        $tarea = new Task($id);
        $tarea->display();
    }

    public function close_plus_js ($scripts = []) 
    {
        ?>
            
            <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <?php 
            
            foreach ($scripts as $script)
                echo "<script src='$script'></script>";
            ?>

            </body>
        </html>

        <?php
    }

}