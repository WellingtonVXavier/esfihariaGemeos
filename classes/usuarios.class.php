<?php
include_once 'Conexao.class.php';

class Usuario
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

    // Mostra dados na tela logado
    public function mostraDadosUsuario($query)
    {
        $mostra = Conexao::getConexao()->prepare($query);
        $mostra->execute();

        if ($mostra->rowCount() > 0) {
            while ($linha = $mostra->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td class="text-center align-middle">
                        <?php echo $linha['id_usuario']; ?>
                    </td>

                    <td class="align-middle">
                        <?php echo $linha['nome']; ?>
                    </td>

                    <td class="align-middle">
                        <?php echo $linha['email']; ?>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo $linha['login']; ?>
                    </td>

                    <td class="text-center align-middle">
                        <?php
                        if ($linha['nivel'] == 0) {
                            ?>
                            <i class="fa-solid fa-unlock text-danger" data-toggle="tooltip" data-placement="right"
                                title="Administrador"></i>
                            <?php
                        } else {
                            ?>
                            <i class="fa-solid fa-lock" data-toggle="tooltip" data-placement="right" title="Comum"></i>
                            <?php
                        }
                        ?>
                    </td>

                    <td class="text-center align-middle">
                        <a href="altera-usuario.php?id_usuario=<?php echo $linha['id_usuario']; ?>" data-toggle="tooltip"
                            data-placement="right" title="Alterar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>

                    <td class="text-center align-middle">
                        <a href="exclui-usuario.php?id_usuario=<?php echo $linha['id_usuario']; ?>" data-toggle="tooltip"
                            data-placement="right" title="Excluir">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>

                    <?php
                    if ($linha['ativo'] == 1) {
                        ?>
                        <td class="text-center align-middle">
                            <a href="desativa-usuario.php?id_usuario=<?php echo $linha['id_usuario']; ?>" data-toggle="tooltip"
                                data-placement="right" title="Ativado, deseja desativar?">
                                <i class="fa-solid fa-check"></i>
                            </a>
                        </td>
                        <?php
                    } else {
                        ?>
                        <td class="text-center align-middle">
                            <a href="ativa-usuario.php?id_usuario=<?php echo $linha['id_usuario']; ?>" data-toggle="tooltip"
                                data-placement="right" title="Desativado, deseja ativar?" class="text-danger">
                                <i class="fa-sharp fa-solid fa-xmark"></i>
                            </a>
                        </td>
                        <?php
                    }
                    ?>

                    <td class="text-center align-middle">
                        <a href="imprimir-usuario.php?id_usuario=<?php echo $linha['id_usuario']; ?>" data-toggle="tooltip"
                            data-placement="right" title="Imprimir">
                            <i class="fa-solid fa-print"></i>
                        </a>
                    </td>
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

    // Função para ativar um usuário
    public function ativa($id_usuario)
    {
        try {
            $sql = 'UPDATE tab_usuarios 
                        SET ativo = 1 
                        WHERE id_usuario = :id_usuario';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':id_usuario', $id_usuario);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Função para desativar um usuário
    public function desativa($id_usuario)
    {
        try {
            $sql = 'UPDATE tab_usuarios
                       SET ativo = 0 
                       WHERE id_usuario = :id_usuario';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':id_usuario', $id_usuario);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Função para excluir um usuário
    public function exclui($id_usuario)
    {
        try {
            $sql = 'DELETE FROM tab_usuarios 
                    WHERE id_usuario = :id_usuario';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':id_usuario', $id_usuario);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Função para inserir um usuário
    public function insere($nome, $email, $login, $nivel)
    {
        $sql = 'SELECT * FROM tab_usuarios
                    WHERE email = :email OR login = :login';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindValue(':email', $email);
            $query->bindValue(':login', $login);
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
                $sql = 'INSERT INTO tab_usuarios (nome,email,login,senha,frase,nivel,ativo) VALUES (?,?,?,?,?,?,1)';
                try {
                    $query = Conexao::getConexao()->prepare($sql);
                    $query->bindValue(1, $nome);
                    $query->bindValue(2, $email);
                    $query->bindValue(3, $login);
                    $query->bindValue(4, hash('sha256', '123'));
                    $query->bindValue(5, 'padrão');
                    $query->bindValue(6, $nivel);
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

    // Função para obter o ID do usuário
    public function buscaID($id_usuario)
    {
        $sql = 'SELECT * FROM tab_usuarios
                    WHERE id_usuario = :id_usuario';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->execute(array(':id_usuario' => $id_usuario));
            $linhaSelecionada = $query->fetch(PDO::FETCH_ASSOC);
            return $linhaSelecionada;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Função para alterar um usuario
    public function altera($nome, $email, $login, $nivel, $id_usuario)
    {
        $sql = 'UPDATE tab_usuarios 
                    SET nome=:nome, email=:email, login=:login, nivel=:nivel
                    WHERE id_usuario=:id_usuario';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindParam(':nome', $nome);
            $query->bindParam(':email', $email);
            $query->bindParam(':login', $login);
            $query->bindParam(':nivel', $nivel);
            $query->bindParam(':id_usuario', $id_usuario);
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

    // Função para inserir um cadastro novo
    public function cadastro($nome, $data, $CPF, $senha, $senha2, $telefone)
    {
        if (empty($nome) || empty($data) || empty($CPF) || empty($senha) || empty($senha2) || empty($telefone)) {
            $_SESSION['mensagem'] = 'Preencha todos os Campos!';
            $_SESSION['tipo_mensagem'] = 'warning';
        } else {
            $sql = 'SELECT * FROM cliente WHERE CPF = :cpf';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindValue(':cpf', $CPF);
            $query->execute();
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($dados) > 0) {
                $_SESSION['mensagem'] = 'Já existe um usuário cadastrado com esse CPF';
                $_SESSION['tipo_mensagem'] = 'warning';
            } else {
                if ($senha == $senha2) {
                    $senha = hash('sha256', $senha);
                    $sql = 'INSERT INTO cliente (NomeCompleto,DataNascimento,CPF,Telefone,Ativo,Senha) VALUES(?,?,?,?,1,?)';

                    $query = Conexao::getConexao()->prepare($sql);
                    $query->bindValue(1, $nome);
                    $query->bindValue(2, $data);
                    $query->bindValue(3, $CPF);
                    $query->bindValue(4, $telefone);
                    $query->bindValue(5, $senha);
                    $query->execute();
                    $_SESSION['mensagem'] = 'Cadastrado(a) com sucesso';
                    $_SESSION['tipo_mensagem'] = 'success';

                    header('Location: ./');
                } else {
                    $_SESSION['mensagem'] = 'As senhas digitadas são diferentes!';
                    $_SESSION['tipo_mensagem'] = 'warning';
                }
            }
        }
    }

    //função para lembrara a senha
    public function lembrarSenha($email)
    {
        if (empty($email)) {
            echo '
                <h5 class="col-md-4 mx-auto alert alert-warning text-center">
                <i class="fa-solid fa-triangle-exclamation"></i> Digite seu e-mail
                </h5>
            ';
        } else {
            $sql = 'SELECT * FROM tab_usuarios WHERE email = :email';
            try {
                $query = Conexao::getConexao()->prepare($sql);
                $query->bindParam(':email', $email);
                $query->execute();
                $dados = $query->fetch(PDO::FETCH_ASSOC);

                if ($dados != false && is_array($dados) && count($dados) > 0) {
                    $nome = $dados['nome'];
                    $frase = $dados['frase'];

                    header('location: envia-email.php?nome=' . $nome . '&email=' . $email . '&frase=' . $frase);
                } else {
                    echo '<h5 class="col-md-4 mx-auto alert alert-danger text-center">
                        <i class="fa-solid fa-bomb"></i> E-mail não cadastrado!
                        </h5>';
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}
?>