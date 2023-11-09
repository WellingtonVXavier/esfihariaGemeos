<?php
session_start();
include_once '../classes/Cliente.class.php';

if (!isset($_SESSION['Cargo'])) {
    header('Location: ./');
} else {
    include_once 'cabecalho-admin.php';
}
?>

<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a style="color: #5b1a29;" href="sistema-gemeos.php"><i class="fa-solid fa-house" style="color: #5b1a29;"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a style="color: #E00D0D;" href="clientes.php"><i class="fa-solid fa-users" style="color: #E00D0D;"></i> Clientes</a></li>
    </ol>
</nav>
<h3 class="alert text-center mt-5" style="font-family: papyrus; color: #fdd738; background-color: #5b1a29;">
<a class="mt-1 btn btn-sm btn-warning float-left" href="sistema-gemeos.php"> <i class="fa-solid fa-left-long"></i> Voltar </a>
Clientes Cadastrados
</h3>

<div class="table-responsive mt-3">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Nome</th>
            <th class="text-center">Nascimento</th>
            <th class="text-center">CPF</th>
            <th class="text-center">Fone</th>
            <th class="text-center">Situação</th>
            <th class="text-center">Resetar</th>
        </tr>

        <?php
        $query = 'SELECT * FROM cliente';
        // Quantidade de registros por página
        $registros_por_pagina = 5;

        $mostrar = new Cliente();
        $novaQuery = $mostrar->paginacao($query, $registros_por_pagina);
        $mostrar->mostraDadosAdmin($novaQuery);
        ?>

        <tr>
            <td colspan="10" class="pb-0">
                <div class="text-center">
                    <?php $mostrar->link_paginacao($query, $registros_por_pagina); ?>
                </div>
            </td>
        </tr>
    </table>
</div>

<?php
include_once '../rodape.php';
?>