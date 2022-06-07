<?php
session_start();

include 'includes/autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pass']))
    {
        $mail = $_POST['email'];
        $pw = $_POST['pass'];

        $user = new User;

        if ($user->tryLogin($mail, $pw))
        {
            $_SESSION['user'] = $user->getName();
            $_SESSION['role'] = $user->getRole();
            $_SESSION['mail'] = $mail;
            $_SESSION['login'] = true;

            header('location: index.php');
        }
        else 
            header('location: index.php');
           
    }
    else
        header('location: index.php');


}
else
    header('location: index.php');
