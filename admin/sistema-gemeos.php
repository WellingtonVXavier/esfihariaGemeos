<?php
session_start();

if (!isset($_SESSION['Cargo'])) {
    header('Location: ./');
} else {
    include_once 'cabecalho-admin.php';
}
?>
<style>
    .oi {
        background-color: #5b1a29;
        color: #FDD738;
        margin-left: 60px;
    }

    .oi:hover {
        background-color: #FDD738;
        color: #5b1a29;
    }

    .io {
        background-color: #5b1a29;
        color: #FDD738;
    }

    .io:hover {
        background-color: #FDD738;
        color: #5b1a29;
    }
</style>
<div class="mt-3">

    <h3 class="alert text-center" style="color: #FDD738; font-family: papyrus; background-color: #5b1a29;">Gêmeos Connect</h3>

    <nav aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a style="color: #E00D0D;" href="sistema-gemeos.php"><i class="fa-solid fa-house" style="color: #E00D0D;"></i> Dashboard</a></li>
        </ol>
    </nav>
    <div class="row mt-5 border rounded shadow" style="background-color: #5b1a29;">
        <div class="col-3 rounded ml-5 mr-5 mt-3 mb-3 border border-warning" style="background-color: #5b1a29;">
            <h3 class="alert" style="color: #FDD738; font-family: papyrus;">Acesse pedidos</h3>
            <a class="btn btn-lg border-warning mb-3 oi" href="pedidos.php"><i class="fa-brands fa-shopify"></i> Pedidos </a>
        </div>
        <div class="col-3-md rounded ml-5 mr-5 mt-3 mb-3 border border-warning" style="background-color: #5b1a29;">
            <h3 class="alert" style="color: #FDD738; font-family: papyrus;">Acesse produtos</h3>
            <a class="btn btn-lg border-warning mb-3 oi" href="produtos.php"><i class="fa-solid fa-list"></i> Produtos</a>
        </div>
        <div class="col-3 rounded ml-5 mt-3 mb-3 border border-warning" style="background-color: #5b1a29;">
            <h3 class="alert" style="color: #FDD738; font-family: papyrus;">Acesse clientes</h3>
            <a class="btn btn-lg border-warning mb-3 oi" href="clientes.php"><i class="fa-solid fa-users"></i> Clientes </a>
        </div>
    </div>

</div>

<?php
include_once '../rodape.php';
?>