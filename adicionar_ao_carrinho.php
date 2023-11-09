<?php
session_start();

// Verificar se o carrinho existe na sessão, se não, crie-o
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

// Obtenha o ID e a quantidade do produto a ser adicionado
if (isset($_POST['id']) && isset($_POST['quantidade'])) {
    $id = $_POST['id'];
    $quantidade = $_POST['quantidade'];

    // Adicione o produto ao carrinho
    $_SESSION['carrinho'][] = array(
        'id' => $id,
        'quantidade' => $quantidade
    );

    // Redireciona de volta para a página de produtos
    header("Location: novo-pedido.php?ok"); 
    //exit();
}
?>