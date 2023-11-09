<?php
session_start();
include_once '../classes/Cliente.class.php';

$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
$desativa = new Cliente();
$desativa->desativa($id_cliente);

echo '<script>history.go(-1);</script>';
?>