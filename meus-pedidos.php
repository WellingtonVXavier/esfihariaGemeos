<?php
session_start();
include_once 'classes/Pedido.class.php';

if (!isset($_SESSION['Id'])) {
    header('Location: ./');
    include_once 'rodape.php';
    exit;
} else {
    include_once 'cabecalho.php';
}
?>
<h3 class="alert text-center mt-5" style="font-family: papyrus; color: #fdd738; background-color: #5b1a29;">Seus últimos pedidos com a gente! <a href="novo-pedido.php" class="btn btn-success float-right"><i class="fa-solid fa-cart-plus"></i> Novo Pedido</a></h3>
<div class="table-responsive mt-3">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th class="text-center">Número Pedido</th>
            <th class="text-center">Status</th>
            <th class="text-center">Data</th>
            <th class="text-center">Valor</th>

        </tr>

        <?php
        $mostrar = new pedido();
        $mostrar->mostraPedidos($_SESSION['Id']);
        ?>

        
    </table>
</div> 


<?php
include_once 'rodape.php';
?>


