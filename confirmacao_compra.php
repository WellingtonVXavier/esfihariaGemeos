<?php
session_start();

include_once './cabecalho.php';
include_once 'classes/Conexao.class.php';
include_once 'classes/Carrinho.class.php';
include_once 'classes/Pedido.class.php';
?>
<!-- Exibir detalhes da compra -->
<h3 class="alert text-center mt-5" style="color: #fdd738; background-color: #5b1a29">Detalhes do Pedido</h3>
<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>Data da Compra</th>
        <th>Nome do Cliente</th>
    </tr>
    <td>
        Data da Compra:
        <?php echo date('d/m/Y - H:i:s'); ?>
    </td>
    <td>
        Nome do Cliente:
        <?php echo $_SESSION['Nome'] ?>
    </td>
</table>



<h3 class="alert text-center mt-5" style="color: #fdd738; background-color: #5b1a29">Resumo dos Produtos</h3>
<table class='table table-bordered table-striped table-hover'>
    <tr>
        <th>Produto</th>
        <th>Foto</th>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>Subtotal</th>
    </tr>
    <?php

    // Variável para calcular o total
    $total_compra = 0;

    // Verifique se o carrinho existe na sessão
    if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
        $Pedido = new pedido;
        $itenspedido = $Pedido->buscaProdutoPedido($_GET['id_pedido']);
        var_dump($itenspedido);
        foreach ($itenspedido as $item) {
            $id = $item['IdProduto'];
            $quantidade_comprada = $item['QuantidadeProduto'];

            // Consultar o banco de dados para obter o nome do produto
            $consulta = "SELECT * FROM produto WHERE Id = :Id";
            $query = Conexao::getConexao()->prepare($consulta);
            $query->bindParam(':Id', $id, PDO::PARAM_INT);
            $query->execute();

            if ($query->rowCount() > 0) {
                $produto = $query->fetch(PDO::FETCH_ASSOC);
                $nome = $produto['Nome'];
                $valor = $produto['Valor'];
                $foto = $produto['imagem'];

                // Calcular o subtotal para este item
                $subtotal = $valor * $quantidade_comprada;

                echo "<tr>";
                echo "<td>$nome</td>";
                echo "<td><img src='./imagens/$foto' width='50'></td>";
                echo "<td>$quantidade_comprada</td>";
                echo "<td>R$ " . number_format($valor, 2) . "</td>";
                echo "<td>R$ " . number_format($subtotal, 2) . "</td>";
                echo "</tr>";
            }

            $total_compra += $subtotal;
        }
    }
    ?>
</table>


<h4 class="alert alert-danger">
    <b>Total da Compra: R$
        <?php echo number_format($total_compra, 2); ?>
    </b>
</h4>

<?php
if (isset($_SESSION['carrinho'])) {
    unset($_SESSION['carrinho']);
}
?>
<div class="mb-3">
    <br><a class="btn btn-dark mt-3" style="color: #fdd738" href="novo-pedido.php"><i class="fa-solid fa-left-long"></i>
    Voltar</a>
    <a href="meus-pedidos.php" class="btn btn-success mt-3"><i class="fa-solid fa-signal"></i>Status Pedido</a>
</div>

<?php
include_once './rodape.php';
?>