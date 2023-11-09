<?php   
    include_once "./classes/Logar.class.php";
        if (!empty($_POST)){
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $logar = new Logar();
            $logar->Cliente($login, $senha);
        }
