<?php
include_once 'Conexao.class.php';

class cardapio
{

    public function mostraProdutos()
    {
        $query = 'SELECT * FROM produto WHERE Ativo = 1';
        $mostra = Conexao::getConexao()->prepare($query);
        $mostra->execute();

        if ($mostra->rowCount() > 0) {
            echo '<div class="row mt-5">';
            while ($linha = $mostra->fetch(PDO::FETCH_ASSOC)) {

                ?>
                    <div class="col-sm-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    <?php echo $linha['Nome'] ?>
                                </h5>
                               <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="card-text"><?php echo $linha['Descricao'] ?></p>
                                </div>
                                <div class="col-md-6">
                                    <img src="imagens/<?php echo $linha['imagem'] ?>" alt="<?php echo $linha['Nome']?>" width="200" height="100" class="rounded">
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                <?php
            }
            echo '</div>';
        }
    }
}
?>