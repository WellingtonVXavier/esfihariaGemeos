<?php
session_start();

// Verifique se o carrinho existe na sessão
if (isset($_SESSION['carrinho'])) {
    $id_produto = $_GET['id_produtos']; // Obtém o ID do produto a ser removido

    // Percorra o carrinho e encontra o índice do item a ser removido
    foreach ($_SESSION['carrinho'] as $indice => $item) {
        if ($item['id_produto'] == $id_produto) {
            // Remove o item do carrinho
            unset($_SESSION['carrinho'][$indice]);
            break; // Sai do loop após a remoção
        }
    }

    if (empty($_SESSION['carrinho'])) {
        unset($_SESSION['carrinho']);
    }
}

// Redirecione de volta para a página do carrinho ou onde desejar
header("Location: carrinho.php");
exit();
?>