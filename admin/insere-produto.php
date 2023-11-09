<?php
session_start();
if (!$_SESSION['Cargo']) {
    header('Location: ./');
} else {
    include_once '../classes/Produto.class.php';
    include_once 'cabecalho-admin.php';
}

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $foto = $_FILES['imagens']['name'];

    if (empty($nome) || empty($descricao) || empty($valor) || empty($foto)) {
        $_SESSION['mensagem'] = 'Preencha todos os campos!';
        $_SESSION['tipo_mensagem'] = 'warning';
    } else {
        // Criar os caminhos das imagens
        $img_grd = '../imagens/' . $foto;

        // Chama a classe e instancia o objeto
        include_once '../classes/Image.class.php';
        $img = new Image();

        $insere = new produto();
        $insere->insere($nome, $descricao, $valor, $foto);
    }
}
?>

<div class="col-md-4 mx-auto shadow-lg border border-warning rounded " style="margin-top: 50px ;background-color: #5b1a29; margin-bottom: 50px;">

    <h3 class="alert text-center mt-5" style="font-family: papyrus; color: #fdd738; background-color: #5b1a29;" data-toggle="tooltip" data-placement="right" title="Novo produto!">Novo Produto</h3>

    <form name="form1" id="form1" method="post" enctype="multipart/form-data">

        <label for="nome" style="color: #fdd738; font-family: papyrus; font-size: large;">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" autofocus>

        <label for="descricao" style="color: #fdd738; font-family: papyrus; font-size: large;">Descrição</label>
        <input type="text" name="descricao" id="descricao" class="form-control">

        <label for="valor" style="color: #fdd738; font-family: papyrus; font-size: large;">Valor</label>
        <input type="text" name="valor" id="valor" class="form-control">

        <label for="imagem" style="color: #fdd738; font-family: papyrus; font-size: large;">Foto</label>
        <input type="file" name="imagem" id="imagem" class="form-control">

        <button type="submit" name="submit" id="submit" class="btn btn-warning btn-block mt-3 mb-3">
            <i class="fa-solid fa-floppy-disk"></i> Salvar
        </button>

        <a href="sistema-gemeos.php" class="btn btn-dark mt-3 mb-3" style="color: #fdd738">
            <i class="fa-solid fa-angles-left" style="color: #fdd738;"></i> Voltar
        </a>

    </form>

</div>

<?php
include_once '../rodape.php';
?>