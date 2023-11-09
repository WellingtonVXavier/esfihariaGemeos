<?php
include_once 'Conexao.class.php';

class produto
{

    public function mostraProduto()
    {
        $query = 'SELECT * FROM produto';
        $mostra = Conexao::getConexao()->prepare($query);
        $mostra->execute();

        if ($mostra->rowCount() > 0) {
            while ($linha = $mostra->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td class="text-center align-middle">
                        <?php echo $linha['Id']; ?>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo $linha['Nome']; ?>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo $linha['Descricao']; ?>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo $linha['Valor']; ?>
                    </td>

                    <td class="text-center align-middle">
                        <img src="../imagens/<?php echo $linha['imagens']; ?>" width="200" height="100" class="rounded">
                    </td>

                    <td class="text-center align-middle">
                        <a href="altera-produto.php?id_produto=<?php echo $linha['Id']; ?>" data-toggle="tooltip" data-placement="right"
                            title="Alterar" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>

                    <!-- If para o status do pedido -->
                    <?php
                    if ($linha['Ativo'] == 1) {
                        ?>
                        <td class="text-center align-middle">
                            <a href="desativa-produto.php?id_produto=<?php echo $linha['Id']; ?>" data-toggle="tooltip"
                                data-placement="right" title="Ativado, deseja desativar?" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-check"></i>
                            </a>
                        </td>
                        <?php
                    } else {
                        ?>
                        <td class="text-center align-middle">
                            <a href="ativa-produto.php?id_produto=<?php echo $linha['Id']; ?>" data-toggle="tooltip" data-placement="right"
                                title="Desativado, deseja ativar?" class="btn btn-danger btn-sm">
                                <i class="fa-sharp fa-solid fa-xmark"></i>
                            </a>
                        </td>
                        <?php
                    }
                    ?>
                    <td class="text-center align-middle">
                        <button class="btn btn-danger btn-sm" onclick="mostrarConfirmacaoDeletar(<?php echo $linha['Id']; ?>)">

                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                    <!-- <a href="exclui-produto.php?id_produto=<?php echo $linha['Id']; ?>" data-toggle="tooltip" data-placement="right" title="Excluir">
                            <i class="fa-solid fa-trash"></i>
                        </a> -->
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="10" class="alert alert-danger text-center">
                    <h5>Não há registros!</h5>
                </td>
            </tr>
            <?php
        }
    }

    public function ativa($id_produto)
    {
        try {
            $sql = 'UPDATE produto
                        SET ativo = 1 
                        WHERE Id = :id_produto';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':id_produto', $id_produto);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Função para desativar uma pessoa
    public function desativa($id_produto)
    {
        try {
            $sql = 'UPDATE produto 
                       SET ativo = 0 
                       WHERE Id = :id_produto';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':id_produto', $id_produto);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function buscaID($id_produto)
    {
        $sql = 'SELECT * FROM produto
                    WHERE Id = :id_produto';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->execute(array(':id_produto' => $id_produto));
            $linhaSelecionada = $query->fetch(PDO::FETCH_ASSOC);
            return $linhaSelecionada;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function alteraProduto($nome, $descricao, $valor, $id_produto)
    {
        $sql = 'UPDATE produto 
                    SET nome=:nome, descricao=:descricao, valor=:valor
                    WHERE Id=:id_produto';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':nome', $nome);
            $query->bindParam(':descricao', $descricao);
            $query->bindParam(':valor', $valor);
            $query->bindParam(':id_produto', $id_produto);
            $query->execute();

            $_SESSION['mensagem'] = 'A alteração no produto foi realizada com sucesso!';
            $_SESSION['tipo_mensagem'] = 'success';
            header('Location: produtos.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insere($nome, $descricao, $valor, $imagem)
    {

        $sql = 'INSERT INTO produto (nome,descricao,valor,ativo,imagem) VALUES (?,?,?,1,?)';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindValue(1, $nome);
            $query->bindValue(2, $descricao);
            $query->bindValue(3, $valor);
            $query->bindValue(4, $imagem);
            $query->execute();

            $_SESSION['mensagem'] = 'O Produto, ' . $nome . ' foi cadastrado com sucesso';
            $_SESSION['tipo_mensagem'] = 'success';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Função para excluir uma Produto
    public function exclui($id_produto)
    {
        try {
            $sql = 'DELETE FROM produto 
                WHERE Id = :id_produto';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':id_produto', $id_produto);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Função para alterar a foto de um produto
    public function alteraFoto($id_produto, $foto)
    {
        try {
            $sql = 'UPDATE produto
                    SET imagem = :foto
                    WHERE Id = :id_produto';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':foto', $foto);
            $query->bindParam(':id_produto', $id_produto);
            $query->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>