<?php
session_start();
include_once '../classes/Cliente.class.php';

$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
$reseta = new Cliente();
$reseta->Reseta($id_cliente);

echo '<script>history.go(-1);</script>';
?>