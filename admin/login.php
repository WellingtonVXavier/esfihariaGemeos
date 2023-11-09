<?php   
    include_once "../classes/login.class.php";
        if (!empty($_POST)){
            $login = $_POST['CPF'];
            $senha = $_POST['senha'];
            $logar = new login();
            $logar->Funcionario($login, $senha);
        }
