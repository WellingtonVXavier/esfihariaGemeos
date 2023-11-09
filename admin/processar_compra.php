<?php
session_start();

include_once '../classes/Conexao.class.php';
include_once '../classes/Carrinho-admin.class.php';

// Verificar se o carrinho existe na sessão
if (!isset($_SESSION['carrinho'])) {
    // Redirecionar ou exibir uma mensagem de erro, pois o carrinho está vazio
    header("Location: sistema-gemeos.php");
    exit();
}
$bd = Conexao::getConexao();
$carrinho = new Carrinho($bd);
$carrinho->listarProdutos();

$total = $_GET['total'];

// Inserir os dados do pedido na tabela de pedidos
$sql = 'INSERT INTO pedido (IdFuncionario, IdCliente, IdStatus, Data, ValorTotal, FlgAbertoFechado) VALUES (?, 1, 1, now(), ?, 1)';
$query = Conexao::getConexao()->prepare($sql);
$query->bindValue(1, $_SESSION['Id']);
$query->bindValue(2, $total);
$query->execute();

// Obter o ID do pedido inserido
$idPedido = Conexao::getConexao()->lastInsertId();


// Função para inserir na tabela itempedido
function inserirItemPedido($idPedido, $idProduto, $quantidadeProduto, $valorItem) {
    $sql = 'INSERT INTO itempedido (IdPedido, IdProduto, QuantidadeProduto, ValorItem, FlgCancelado) VALUES (?, ?, ?, ?, 0)';
    $query = Conexao::getConexao()->prepare($sql);
    $query->bindValue(1, $idPedido);
    $query->bindValue(2, $idProduto);
    $query->bindValue(3, $quantidadeProduto);
    $query->bindValue(4, $valorItem);
    $query->execute();
}

// Na classe Carrinho, após obter as informações do produto, você pode chamar a função de inserção da seguinte maneira:
foreach ($_SESSION['carrinho'] as $item) {
    $idProduto = $item['id'];
    $quantidadeProduto = $item['quantidade'];
    
    $produtoInfo = $carrinho->obterInformacoesProduto($idProduto);

    if ($produtoInfo !== null) {
        $valorItem = $produtoInfo['Valor'];
        $flgCancelado = 0;

        // Chamada da função de inserção com os valores corretos
        inserirItemPedido($idPedido, $idProduto, $quantidadeProduto, $valorItem);
    } else {
        echo "Produto não encontrado.";
    }
}

// Exibir mensagem de confirmação da compra ou redirecionar para uma página de confirmação
header("Location: confirmacao_compra.php?id_pedido=$idPedido");
exit();

?>