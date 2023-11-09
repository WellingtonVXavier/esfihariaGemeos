<?php
session_start();

include_once '../classes/Conexao.class.php';
include_once '../classes/Carrinho-admin.class.php';
include_once 'cabecalho-admin.php';
?>

<style>
    .oi {
        background-color: #5b1a29;
        color: #FDD738;
    }

    .oi:hover {
        background-color: #FDD738;
        color: #5b1a29;
    }
</style>

<h3 class="alert text-center mt-5" style="font-family: papyrus; color: #fdd738; background-color: #5b1a29;">Carrinho de Produtos</h3>
<table class='table table-bordered table-striped table-hover'>
    <tr>
        <th>Nome do Produto</th>
        <th class='text-center'>Quantidade</th>
        <th class='text-center'>Preço Unitário</th>
        <th class='text-center'>Subtotal</th>
        <th class='text-center'>Ação</th>
    </tr>

    <?php
    $bd = new Conexao();
    $carrinho = new Carrinho($bd);
    $carrinho->listarProdutos();
    ?>
</table>

<a href="insere-pedido.php" class="btn btn-dark mt-3 mb-3" style="color: #fdd738">
    <i class="fa-solid fa-angles-left" style="color: #fdd738;"></i> Voltar
</a>
<a class="btn border-warning btn-danger" href="finalizar_compra.php">
    <i class="fa-brands fa-shopify"></i> Finalizar
</a>

<?php
include_once '../rodape.php';
?>