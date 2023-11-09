<?php

session_start();

include_once '../classes/Conexao.class.php';
include_once '../classes/Carrinho-admin.class.php';
include_once 'cabecalho-admin.php';
if(!isset($_SESSION['Id'])){
    header('Location: ./');
}
?>
        <a href="carrinho.php" class="btn btn-block btn-dark mt-5" style="color: #fdd738;"><i class="fa-solid fa-cart-shopping"></i> Pedido</a>
        <?php
// Verifica se a variável de sessão 'carrinho' existe
$carrinho = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : null;

if (isset($_GET['ok'])) {
    $_SESSION['mensagem'] = 'Produto Adicionado ao Carrinho!';
    $_SESSION['tipo_mensagem'] = 'success';
}

try {
    // Obtém uma conexão com o banco de dados usando a classe de conexão
    $bd = Conexao::getConexao();

    $sql = "SELECT * FROM produto WHERE Ativo = 1";
    $query = $bd->prepare($sql);
    $query->execute();

    if ($query->rowCount() > 0) {
        while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {

            echo "<div class='produto'>";
            echo "<div class='card-container mb-4' >";
            echo "<div class='card float-left m-2' style='width: 340px;' >";
            echo "<div class='card-body'>";

            echo "<img src='../imagens/" . $linha["imagem"] . "' class='card-img-top' alt='Imagem do produto' width='200' height='200'>";

            $novoTexto = (strlen($linha["Nome"]) > 35) ? substr(strtoupper($linha["Nome"]), 0, 35) . " ..." : strtoupper($linha["Nome"]);
            echo "<h5 class='card-title'>" . $novoTexto . "</h5>";
            echo "<p class='card-text'><b>R$ " . $linha["Valor"] . "</b></p>";
            echo "<p class='card-text'>" . $linha["Descricao"] . "</p>";

            echo '<form method="post" action="adicionar_ao_carrinho.php">';
            echo '<input type="hidden" name="id" value="' . $linha["Id"] . '">';
            echo 'Quantidade: <input type="number"  class="form-control mt-4" name="quantidade" value="1" min="1" max=""> <br>';
            echo '<button type="submit" class="btn btn-block mt-3" style="background-color: #5b1a29; color: #fdd738 ">Adicionar ao Carrinho</button>';
            echo '</form>';

            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Não há produtos cadastrados!</p>";
    }
} catch (PDOException $e) {
    echo "Erro ao buscar produtos: " . $e->getMessage();
}


include_once '../rodape.php';
?>