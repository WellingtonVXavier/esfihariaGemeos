<?php
session_start();

include_once 'cabecalho-admin.php';
include_once '../classes/Conexao.class.php';
include_once '../classes/Carrinho-admin.class.php';
include_once '../classes/Pedido.class.php';
?>
<!-- Exibir detalhes da compra -->
<h3 class="alert text-center mt-5" style="color: #fdd738; background-color: #5b1a29">Detalhes do Pedido</h3>
<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>Data da Compra</th>
        <th>Nome do Colaborador</th>
    </tr>
    <td>
        Data da Compra:
        <?php echo date('d/m/Y - H:i:s'); ?>
    </td>
    <td>
        Nome do Colaborador:
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
                echo "<td><img src='../imagens/$foto' width='50'></td>";
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
<br><a class="btn btn-dark mt-3 mb-3" style="color: #fdd738" href="pedidos.php"><i class="fa-solid fa-left-long"></i>
    Voltar</a>

<?php
include_once '../rodape.php';
?>