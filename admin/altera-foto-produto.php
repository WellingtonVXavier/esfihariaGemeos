<?php
session_start();
include_once '../classes/Produto.class.php';
include_once '../cabecalho.php';
if (isset($_POST['submit'])) {
    $id_produto = $_GET['id_produto'];
    $foto = $_FILES['imagem']['name'];

    // Chama a classe e instancia o objeto
    include_once '../classes/Image.class.php';
    $img = new Image();

    // Se a conversão foi bem sucedida, gravar os dados no BD

        $altera = new produto();
        $altera->alteraFoto($id_produto, $foto);
        header('Location: produtos.php');

}


if (isset($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];
    $busca = new produto();
    extract($busca->buscaID($id_produto));
}
?>

<h5 class="alert mt-3" style="font-family: papyrus; color: #fdd738; background-color: #5b1a29;">
    <i class="fa-solid fa-pen-to-square"></i> Altera foto
</h5>

<form name="form1" id="form1" method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="col">
            <img src="../imagens/<?php echo $imagem; ?>" id="mostra_foto" style="border-radius: 50%;
                                border: 1px solid #BBB; width: 300px; height: 250px;">
            <p class="ml-5">
                <b>Foto atual: </b>
                <?php echo $imagem; ?><br>
                <span id="texto_nova_foto" style="display: none;">
                    <b>Nova foto: </b>
                </span>
            </p>
        </div>

        <div class="col">
            <div class="custom-file mt-5">
                <input type="file" name="imagem" id="imagem" onchange="mostraImagem();" class="custom-file-input">
                <label class="custom-file-label">
                    Selecione a foto
                </label>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-info mt-3">
                <i class="fa-solid fa-pen-to-square"></i> Alterar
            </button>

            <a href="produtos.php" class="btn btn-secondary mt-3">
                <i class="fa-solid fa-angles-left"></i> Voltar
            </a>

        </div>
    </div>


</form>

<?php
include_once '../rodape.php';
?>