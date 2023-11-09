<?php

include_once 'classes/usuarios.class.php';
include_once 'cabecalho.php';

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $CPF = $_POST['CPF'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    $telefone = $_POST['telefone'];

    $cadastrar = new Usuario();
    $cadastrar->cadastro($nome, $data, $CPF, $senha, $senha2, $telefone);
}
?>
<div class="col-md-4 mx-auto shadow-lg border border-warning rounded "
    style="margin-top: 100px ;background-color: #5b1a29">
    <h3 class="alert text-center mt-3 mb-3" style="color: #fdd738">
        <i class="fa-solid fa-user" style="color: #fdd738;"></i> Cadastre-se
    </h3>

    <form name="form1" id="form1" method="post">
        <input type="text" name="nome" id="nome" class="form-control mb-3" placeholder="Nome" autofocus>

        <input type="date" name="data" id="data" class="form-control mb-3">

        <input type="text" name="CPF" id="CPF" class="form-control mb-3" placeholder="CPF">

        <input type="password" name="senha" id="senha" class="form-control mb-3" placeholder="Senha">

        <input type="password" name="senha2" id="senha2" class="form-control mb-3" placeholder="Confirme a senha">

        <input type="phone" name="telefone" id="telefone" class="form-control" placeholder="Telefone/Celular">

        <button type="submit" name="submit" id="submit" class="btn btn-warning btn-block mt-3 mb-3">
            <i class="fa-solid fa-floppy-disk"></i> Salvar
        </button>

        <a href="./" class="btn btn-dark mt-3 mb-3" style="color: #fdd738">
            <i class="fa-solid fa-angles-left" style="color: #fdd738;"></i> Voltar
        </a>
    </form>
</div>

<?php
include_once 'rodape.php';
?>