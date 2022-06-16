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
            $_SESSION['id'] = $user->getId();
            $_SESSION['mail'] = $mail;
            $_SESSION['login'] = true;

            if (isset($_POST['remember']))
                {
                    setcookie('email', $mail, time() + (10 * 365 * 24 * 60 * 60), "/");
                }
            else 
                {
                    if (isset($_COOKIE['email']))
                    {
                        unset($_COOKIE['email']); 
                        setcookie('email', $mail, time() - (3600), "/");    
                    }
                                    
                }
                
                

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
