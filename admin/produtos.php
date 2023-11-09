<?php
session_start();


if (!isset($_SESSION['Cargo'])) {
    header('Location: ./');
    include_once 'rodape.php';
    exit;
} else {
    include_once 'cabecalho-admin.php';
    include_once '../classes/Produto.class.php';
}
?>
<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a style="color: #5b1a29;" href="sistema-gemeos.php"><i class="fa-solid fa-house" style="color: #5b1a29;"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a style="color: #E00D0D;" href="produtos.php"><i class="fa-solid fa-list" style="color: #E00D0D;"></i> Produtos</a></li>
    </ol>
</nav>
<h3 class="alert text-center mt-5" style="font-family: papyrus; color: #fdd738; background-color: #5b1a29;"><a class="mt-1 btn btn-sm btn-warning float-left" href="sistema-gemeos.php"> <i class="fa-solid fa-left-long"></i> Voltar</a> Produtos Cadastrados <a class="mt-1 btn btn-sm btn-success float-right" href="insere-produto.php"><i class="fa-solid fa-plus"></i></a></h3>

<div class="table-responsive mt-3">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th class="text-center">Código do Produto</th>
            <th class="text-center">Nome</th>
            <th class="text-center">Descrição</th>
            <th class="text-center">Valor</th>
            <th class="text-center">Imagem</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Status</th>
            <th class="text-center">Excluir</th>
            

        </tr>

        <?php
        $mostrar = new produto();
        $mostrar->mostraProduto();
        ?>

        
    </table>
</div> 


<?php
include_once '../rodape.php';
?>


