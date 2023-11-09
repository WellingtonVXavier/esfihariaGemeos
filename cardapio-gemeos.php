<?php
session_start();
include_once 'cabecalho.php';
include_once 'classes/Cardapio.class.php';
?>

<?php

$mostrar = new cardapio();
$mostrar->mostraProdutos();

?>

<?php
include_once 'rodape.php';
?>