<?php
session_start();
include_once '../classes/Pedido.class.php';

if (!isset($_SESSION['Cargo'])) {
    header('Location: ./');
    include_once 'rodape.php';
    exit;
} else {
    include_once 'cabecalho-admin.php';
}
?>

<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a style="color: #5b1a29;" href="sistema-gemeos.php"><i class="fa-solid fa-house" style="color: #5b1a29;"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a style="color: #E00D0D;" href="pedidos.php"><i class="fa-brands fa-shopify" style="color: #E00D0D;"></i> Pedidos</a></li>
    </ol>
</nav>

<h3 class="alert text-center mt-5" style="font-family: papyrus; color: #fdd738; background-color: #5b1a29;">
<a class="mt-1 btn btn-sm btn-warning float-left" href="sistema-gemeos.php"> <i class="fa-solid fa-left-long"></i> Voltar </a>
Pedidos 
<a href="insere-pedido.php"><i class="fa-solid fa-cart-plus btn btn-success mt-1 float-right"></i></a></h3>

<div class="table-responsive mt-3">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th class="text-center">Número Pedido</th>
            <th class="text-center">Funcionário</th>
            <th class="text-center">Número Cliente</th>
            <th class="text-center">Status</th>
            <th class="text-center">Data</th>
            <th class="text-center">Valor</th>
        </tr>

        <?php
        $query = 'SELECT * FROM pedido';
        // Quantidade de registros por página
        $registros_por_pagina = 5;

        $mostrar = new pedido();
        $novaQuery = $mostrar->paginacao($query, $registros_por_pagina);
        $mostrar->mostraPedidosAdmin($novaQuery);
        ?>

        <tr>
            <td colspan="10" class="pb-0">
                <div class="text-center">
                    <?php $mostrar->link_paginacao($query, $registros_por_pagina); ?>
                </div>
            </td>
        </tr>
    </table>

        
    </table>
</div> 


<?php
include_once '../rodape.php';
?>


