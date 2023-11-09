<?php
include_once 'Conexao.class.php';

class ItemPedido
{
    // Calcula a quantidade de registros por página
    public function paginacao($query, $registros_por_pagina)
    {
        $posicao_inicial = 0;
        if (isset($_GET['pagina_no'])) {
            $posicao_inicial = ($_GET['pagina_no'] - 1) * $registros_por_pagina;
        }
        $query2 = $query . " limit $posicao_inicial, $registros_por_pagina";
        return $query2;
    }

    // Mostra dados na tela inicial
    public function mostraDados($query)
    {
        $mostra = Conexao::getConexao()->prepare($query);
        $mostra->execute();

        if ($mostra->rowCount() > 0) {
            while ($linha = $mostra->fetch(PDO::FETCH_ASSOC)) {
?>
                <tr>
                    <td class="text-center align-middle">
                        <?php echo $linha['id_pessoa']; ?>
                    </td>

                    <td class="align-middle">
                        <?php echo $linha['nome']; ?>
                    </td>

                    <td class="align-middle">
                        <?php echo $linha['email']; ?>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo $linha['fone']; ?>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo date('d/m/Y', strtotime($linha['criado_em'])); ?>
                    </td>

                    <td class="text-center align-middle">
                        <img src="img_peq/<?php echo $linha['foto']; ?>">
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" class="alert alert-danger text-center">
                    <h5>Não há registros!</h5>
                </td>
            </tr>
<?php
        }
    }

    // Insere os produtos dentro do Select (Insere-Pedidos)
    public function SelectProdutos()
    {
        $sql = 'SELECT * FROM produto
                    WHERE Ativo = 1';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->execute();
            $mostra = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($query->rowCount() > 0) {
                foreach ($mostra as $linha) {
                    echo '
                    <option value="' . $linha['Id'] . '">' . $linha['Nome'] . '</option>
                ';
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Cria os links de paginação
    public function link_paginacao($query, $registros_por_pagina)
    {
        $self = $_SERVER['PHP_SELF'];
        $mostra = Conexao::getConexao()->prepare($query);
        $mostra->execute();
        $total_registros = $mostra->rowCount();
        if ($total_registros > 0) {
            echo '<ul class="pagination justify-content-center">';

            $total_de_paginas = ceil($total_registros / $registros_por_pagina);
            $pagina_atual = 1;
            if (isset($_GET['pagina_no'])) {
                $pagina_atual = $_GET['pagina_no'];
            }

            // Links Primeira e voltar
            if ($pagina_atual != 1) {
                $anterior = $pagina_atual - 1;
                echo '
                    <li class="page-item"><a href="' . $self . '?pagina_no=1" class="page-link"><i class="fas fa-angle-double-left"></i></a>
                    </li> 
                    ';

                echo '
                    <li class="page-item"><a href="' . $self . '?pagina_no=' . $anterior . '" class="page-link"><i class="fas fa-angle-left"></i>
                    </a></li> 
                    ';
            } else {
                echo '
                    <li class="page-item disabled"><a href="#" class="page-link"><i class="fas fa-angle-double-left"></i></a>
                    </li> 
                    ';

                echo '
                    <li class="page-item disabled"><a href="#" class="page-link"><i class="fas fa-angle-left"></i>
                    </a></li> 
                    ';
            }

            // Links das páginas centrais
            for ($i = 1; $i <= $total_de_paginas; $i++) {
                if ($i == $pagina_atual) {
                    echo '
                        <li class="page-item active"><a href="' . $self . '?pagina_no=' . $i . '" class="page-link">' . $i . '</a></li>
                        ';
                } else {
                    echo '
                        <li class="page-item"><a href="' . $self . '?pagina_no=' . $i . '" class="page-link">' . $i . '</a></li>
                        ';
                }
            }

            // Links Próxima e última
            if ($pagina_atual != $total_de_paginas) {
                $proxima = $pagina_atual + 1;
                echo '
                    <li class="page-item"><a href="' . $self . '?pagina_no=' . $proxima . '" class="page-link"><i class="fas fa-angle-right"></i></a>
                    </li> 
                    ';

                echo '
                    <li class="page-item"><a href="' . $self . '?pagina_no=' . $total_de_paginas . '" class="page-link"><i class="fas fa-angle-double-right"></i>
                    </a></li> 
                    ';
            } else {
                echo '
                    <li class="page-item disabled"><a href="#" class="page-link"><i class="fas fa-angle-right"></i></a>
                    </li> 
                    ';

                echo '
                    <li class="page-item disabled"><a href="#" class="page-link"><i class="fas fa-angle-double-right"></i>
                    </a></li> 
                    ';
            }
            echo '</ul>';
        }
    }

    // Função para ativar uma pessoa
    public function ativa($id_pessoa)
    {
        try {
            $sql = 'UPDATE tab_pessoas 
                        SET ativo = 1 
                        WHERE id_pessoa = :id_pessoa';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':id_pessoa', $id_pessoa);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Função para desativar uma pessoa
    public function desativa($id_pessoa)
    {
        try {
            $sql = 'UPDATE tab_pessoas 
                       SET ativo = 0 
                       WHERE id_pessoa = :id_pessoa';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':id_pessoa', $id_pessoa);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Função para excluir uma pessoa
    public function exclui($id_pessoa)
    {
        try {
            $sql = 'DELETE FROM tab_pessoas 
                    WHERE id_pessoa = :id_pessoa';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':id_pessoa', $id_pessoa);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Função para inserir uma pesssoa
    public function insere($nome, $email, $fone, $foto)
    {
        $sql = 'SELECT * FROM tab_pessoas
                    WHERE email = :email';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindValue(':email', $email);
            $query->execute();

            if ($query->rowCount() > 0) {
                echo '
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#email").modal("show");
                        });
                    </script>
                    ';
            } else {
                $sql = 'INSERT INTO tab_pessoas (nome,email,fone,criado_em,foto,ativo) VALUES (?,?,?,NOW(),?,1)';
                try {
                    $query = Conexao::getConexao()->prepare($sql);
                    $query->bindValue(1, $nome);
                    $query->bindValue(2, $email);
                    $query->bindValue(3, $fone);
                    $query->bindValue(4, $foto);
                    $query->execute();

                    echo '
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#ok").modal("show");
                        });
                    </script>
                    ';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Função para alterar uma pessoa
    public function altera($nome, $email, $fone, $id_pessoa)
    {
        $sql = 'UPDATE tab_pessoas 
                    SET nome=:nome, email=:email, fone=:fone
                    WHERE id_pessoa=:id_pessoa';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':nome', $nome);
            $query->bindParam(':email', $email);
            $query->bindParam(':fone', $fone);
            $query->bindParam(':id_pessoa', $id_pessoa);
            $query->execute();

            echo '
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#ok").modal("show");
                    });
                </script>
                ';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Função para alterar a foto de uma pessoa
    public function alteraFoto($id_pessoa, $foto)
    {
        try {
            $sql = 'UPDATE tab_pessoas
                        SET foto = :foto
                        WHERE id_pessoa = :id_pessoa';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':foto', $foto);
            $query->bindParam(':id_pessoa', $id_pessoa);
            $query->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>