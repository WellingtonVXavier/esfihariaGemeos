<?php
include_once 'Conexao.class.php';

class pedido
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

    public function mostraPedidosAdmin($query)
    {
        $mostra = Conexao::getConexao()->prepare($query);
        $mostra->execute();

        if ($mostra->rowCount() > 0) {
            while ($linha = $mostra->fetch(PDO::FETCH_ASSOC)) {
?>
                <tr>
                    <td class="text-center align-middle">
                        <?php echo $linha['Id']; ?>
                    </td>

                    <td class="align-middle text-center">
                        <?php echo $linha['IdFuncionario']; ?>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo $linha['IdCliente']; ?>
                    </td>

                    <!-- If para o status do pedido -->
                    <?php
                    switch ($linha['IdStatus']) {
                        case '1':
                    ?>
                            <td class="text-center align-middle">
                                <?php echo 'Em aberto' ?>
                            </td>
                        <?php
                            break;
                        case '2':
                        ?>
                            <td class="text-center align-middle">
                                <?php echo 'Preparando' ?>
                            </td>
                        <?php
                            break;
                        case '3':
                        ?>
                            <td class="text-center align-middle">
                                <?php echo 'Pronto' ?>
                            </td>
                        <?php
                            break;
                        case '4':
                        ?>
                            <td class="text-center align-middle">
                                <?php echo 'Entregue' ?>
                            </td>
                        <?php
                            break;
                        case '5':
                        ?>
                            <td class="text-center align-middle">
                                <?php echo 'Cancelado' ?>
                            </td>
                    <?php
                            break;
                    }
                    ?>

                    <td class="text-center align-middle align-middle">
                        <?php echo date('d/m/Y', strtotime($linha['Data'])); ?>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo $linha['ValorTotal']; ?>
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

    // Função para inserir um pedido
    public function insere($IdFuncionario, $cliente, $valor)
    {
        $sql = 'INSERT INTO pedido (IdFuncionario,IdCliente,IdStatus,Data,ValorTotal, FlgAbertoFechado) VALUES (?,?,1,NOW(),?,1)';
        try {
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindValue(1, $IdFuncionario);
            $query->bindValue(2, $cliente);
            $query->bindValue(3, $valor);
            $query->execute();
            $_SESSION['mensagem'] = 'Novo pedido adicionado com sucesso!';
            $_SESSION['tipo_mensagem'] = 'success';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function buscaProdutoPedido($id)
    {
        $query = 'SELECT * FROM itempedido WHERE IdPedido = ?';
        $mostra = Conexao::getConexao()->prepare($query);
        $mostra->bindParam(1, $id, PDO::PARAM_INT);
        $mostra->execute();
        return $mostra->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostraPedidos($id)
    {
        $query = 'SELECT * FROM pedido WHERE IdCliente = ? ORDER BY Id DESC';
        $mostra = Conexao::getConexao()->prepare($query);
        $mostra->bindParam(1, $id, PDO::PARAM_INT);
        $mostra->execute();

        if ($mostra->rowCount() > 0) {
            $contador = 0;
            while ($linha = $mostra->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td class="text-center align-middle">
                        <?php echo $linha['Id']; ?>
                    </td>
                    <!-- If para o status do pedido -->
                    <?php
                    switch ($linha['IdStatus']) {
                        case '1':
                    ?>
                            <td class="text-center">
                                <?php echo 'Em aberto' ?>
                            </td>
                        <?php
                            break;
                        case '2':
                        ?>
                            <td class="text-center">
                                <?php echo 'Preparando' ?>
                            </td>
                        <?php
                            break;
                        case '3':
                        ?>
                            <td class="text-center">
                                <?php echo 'Pronto' ?>
                            </td>
                        <?php
                            break;
                        case '4':
                        ?>
                            <td class="text-center">
                                <?php echo 'Entregue' ?>
                            </td>
                        <?php
                            break;
                        case '5':
                        ?>
                            <td class="text-center">
                                <?php echo 'Cancelado' ?>
                            </td>
                    <?php
                            break;
                    }
                    ?>

                    <td class="align-middle text-center">
                        <?php echo date('d/m/Y', strtotime($linha['Data'])); ?>
                    </td>

                    <td class="text-center">
                        <?php echo 'R$' . $linha['ValorTotal']; ?>
                    </td>
                </tr>
            <?php
                $contador++;
                if ($contador >= 5) {
                    // Se o contador de linhas atingir 5, sai do loop
                    break;
                }
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
}
?>