<?php
session_start();
include_once '../classes/Produto.class.php';

$id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : null;
$exclui = new produto();
$exclui->exclui($id_produto);

echo '<script>history.go(-1);</script>';
?>