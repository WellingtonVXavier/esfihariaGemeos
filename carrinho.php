<?php
session_start();

include_once 'classes/Conexao.class.php';
include_once 'classes/Carrinho.class.php';
include_once 'cabecalho.php';
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


<?php
if (!isset($_SESSION['vazio'])) {
?>
    <a href="novo-pedido.php" class="btn btn-dark mt-3 mb-3" style="color: #fdd738">
        <i class="fa-solid fa-angles-left" style="color: #fdd738;"></i> Voltar
    </a>
    <a class="btn border-warning oi" href="finalizar_compra.php">
        <i class="fa-brands fa-shopify"></i> Finalizar
    </a>
<?php
} else {
?>
    <a href="novo-pedido.php" class="btn btn-dark mt-3 mb-3" style="color: #fdd738">
        <i class="fa-solid fa-angles-left" style="color: #fdd738;"></i> Voltar
    </a>
<?php
unset($_SESSION['vazio']);
}

include_once 'rodape.php';
?>