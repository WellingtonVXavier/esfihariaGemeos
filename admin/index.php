<?php

include_once '../classes/login.class.php';
include_once 'cabecalho-login.php';

?>
<div class="col-md-4 mx-auto border shadow" style="background-color: #5b1a29">
    <h3 class="alert text-center mt-3 mb-3" style="color: #FDD738; background-color: #5b1a29 ; font-family: papyrus;">
        <i class="fa-solid fa-lock"></i> Acesso ao sistema
    </h3>

    <form name="form1" id="form1" action="login.php" method="post">
        <input type="text" name="CPF" id="CPF" class="form-control" autofocus placeholder="CPF" data-toggle="tooltip" data-placement="right" title="CPF">
        <input type="password" name="senha" id="senha" class="form-control mt-3" placeholder="Senha">
        <div class="row">
            <div class="col">
                <button type="submit" name="submit" id="submit" class="btn btn-warning btn-block mt-3">
                    Entrar
                </button> <br>
                <a href="../" class="btn btn-dark mt-3 mb-3">
                    Voltar
                </a>
            </div>
        </div>
</div>

</form>
</div>

<?php
include_once '../rodape.php';
?>