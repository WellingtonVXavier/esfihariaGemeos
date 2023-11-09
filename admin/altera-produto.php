<?php
session_start();
if (!$_SESSION['Cargo']) {
    header('Location: ./');
} else {
    include_once '../classes/Produto.class.php';
    include_once 'cabecalho-admin.php';
}

if (isset($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];
    $busca = new produto();
    extract($busca->buscaID($id_produto));
}

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    

    if (empty($nome) || empty($descricao) || empty($valor)) {
        $_SESSION['mensagem'] = 'Preencha todos os Campos!';
        $_SESSION['tipo_mensagem'] = 'warning';
    } else {
        $altera = new produto();
        $altera->alteraProduto($nome, $descricao, $valor, $id_produto);
    }
}
?>

<h5 class="alert mt-5" style="font-family: papyrus; color: #fdd738; background-color: #5b1a29;">
    <i class="fa-solid fa-pen-to-square"></i> Editar Produto
</h5>

<form name="form1" id="form1" method="post" enctype="multipart/form-data">

    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" class="form-control" autofocus value="<?php echo $Nome ?>">

    <label for="descricao">Descrição</label>
    <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $Descricao; ?>">

    <div class="row">
        <div class="col">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor" class="form-control" value="<?php echo $Valor; ?>">
        </div>

        <div class="col mt-3">
            <a href="altera-foto-produto.php?id_produto=<?php echo $id_produto; ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $imagem; ?>">
                <img class="rounded shadow" style="width: 200px; height: 200px;" src="../imagens/<?php echo $imagem; ?>" alt="<?php echo $imagem; ?>" title="<?php echo $imagem; ?>">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        </div>
    </div>



    <button type="submit" name="submit" id="submit" class="btn btn-info mt-3">
        <i class="fa-solid fa-pen-to-square"></i> Alterar
    </button>

    <a href="produtos.php" class="btn btn-secondary mt-3">
        <i class="fa-solid fa-angles-left"></i> Voltar
    </a>

</form>


<?php
include_once '../rodape.php';
?>