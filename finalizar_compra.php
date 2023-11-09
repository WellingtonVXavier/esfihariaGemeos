<?php
session_start();

include_once './cabecalho.php';
include_once 'classes/Conexao.class.php';
include_once 'classes/Carrinho.class.php';
include_once 'classes/usuarios.class.php';


if (!isset($_SESSION['carrinho'])) {
    echo "Seu carrinho está vazio.";
} else {
    $carrinho = $_SESSION['carrinho'];

    // Calcular o total da compra
    $total = 0;

    echo "<h4>Resumo da Compra</h4>";
    echo "<table class='table table-bordered table-striped table-hover'>";
    echo "<tr>
                <th>Nome do Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Subtotal</th>
            </tr>";

    foreach ($carrinho as $item) {
        if (isset($item['id'])) {
            $id = $item['id'];
            $quantidade = $item['quantidade'];

            $consulta = "SELECT Nome, Valor FROM produto WHERE Id = :Id";
            $query = Conexao::getConexao()->prepare($consulta);
            $query->bindParam(':Id', $id, PDO::PARAM_INT);
            $query->execute();

            if ($query->rowCount() > 0) {
                $produto = $query->fetch(PDO::FETCH_ASSOC);
                $nome = $produto['Nome'];
                $preco_unitario = $produto['Valor'];

                // Calcule o subtotal
                $subtotal = $preco_unitario * $quantidade;
                $total += $subtotal;

                echo "<tr>";
                echo "<td>$nome</td>";
                echo "<td>$quantidade</td>";
                echo "<td>R$ " . number_format($preco_unitario, 2, ",", ".") . "</td>";
                echo "<td>R$ " . number_format($subtotal, 2, ",", ".") . "</td>";
                echo "</tr>";
            } else {
                echo "Produto não encontrado.";
            }
        } else {
            echo "Chave 'id' não definida no item do carrinho.";
        }
    }
    echo "
        <td colspan='4' class='text-center font-weight-bold'> Total da Compra: R$ " . number_format($total, 2, ",", ".") . "</td>";
    echo "</table>";

    // Exibir o total da compra e o formulário de finalização


    echo '<form method="post" action="processar_compra.php">';
    echo "<a class='btn btn-danger btn-block' href='processar_compra.php?total=$total'>Finalizar Compra</a>";
    echo '</form>';
}

include_once './rodape.php';
?>