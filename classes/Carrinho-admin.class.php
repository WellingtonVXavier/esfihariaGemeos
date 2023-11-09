<?php
include_once '../classes/Conexao.class.php';

class Carrinho
{
    private $bd;
    private $carrinho;

    public function __construct($bd)
    {
        $this->bd = $bd;

        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
        }

        $this->carrinho = $_SESSION['carrinho'];
    }

    public function listarProdutos()
    {
        if (empty($this->carrinho)) {
            $_SESSION['vazio'] = true;
            ?>
            <tr>
                <td colspan="10" class="alert alert-danger text-center">
                    <h5>Seu carrinho está vazio!</h5>
                </td>
            </tr>


            <?php
        } else {

            foreach ($this->carrinho as $item) {
                if (isset($item['id'])) {
                    $id = $item['id'];
                    $quantidade = $item['quantidade'];

                    $produto = $this->obterInformacoesProduto($id);

                    if ($produto !== null) {
                        $nome = $produto['Nome'];
                        $valor = $produto['Valor'];

                        // Calcule o subtotal
                        $subtotal = $valor * $quantidade;

                        echo "<tr>";
                        echo "<td>$nome</td>";
                        echo "<td>$quantidade</td>";
                        echo "<td>R$ " . number_format($valor, 2, ",", ".") . "</td>";
                        echo "<td>R$ " . number_format($subtotal, 2, ",", ".") . "</td>";
                        ?>
                        <td class="text-center align-middle">
                            <button class="btn btn-danger btn-sm" onclick="mostrarConfirmacaoRemover(<?php echo $produto['Id']; ?>)">

                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                        <?php
                        // echo "<td><a href='remover_do_carrinho.php?Id=$id'>Remover</a></td>";
                        echo "</tr>";
                    } else {
                        echo "Produto não encontrado.";
                    }
                } else {

                    echo "Chave 'id' não definida no item do carrinho.";
                }
            }
        }
    }

    public function obterInformacoesProduto($id)
    {
        $consulta = "SELECT Id, Nome, Valor FROM produto WHERE Id = :Id";
        $query = Conexao::getConexao()->prepare($consulta);
        $query->bindParam(':Id', $id, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
            $produtoInfo = $query->fetch(PDO::FETCH_ASSOC);
            
            return $produtoInfo;
        }
        return null;
    }
}