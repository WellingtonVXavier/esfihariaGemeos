<?php
include_once 'Conexao.class.php';
class login
{
    public $dados;
    // Função de login
    public function Funcionario($login, $senha)
    {
        if (empty($login) || empty($senha)) {
            $_SESSION['mensagem'] = 'Preencha todos os campos!';
            $_SESSION['tipo_mensagem'] = 'warning';
        } else {
            $sql = 'SELECT * FROM funcionario WHERE CPF = ? LIMIT 1';
            $query = Conexao::getConexao()->prepare($sql);
            $query->bindValue(1, $login);
            $query->execute();
            $this->dados = $query->fetch(PDO::FETCH_ASSOC);

            if (count($this->dados) > 0) {
                $senha = hash('sha256', $senha);
                if ($senha == $this->dados['Senha']) {
                    if ($this->dados['Ativo'] == 1) {
                        session_start();
                        $_SESSION['Id'] = $this->dados['Id'];
                        $_SESSION['Nome'] = $this->dados['NomeCompleto'];
                        $_SESSION['Cargo'] = $this->dados['IdCargo'];
                        $_SESSION['mensagem'] = 'Bem-vindo(a) ' . $this->dados['NomeCompleto'];
                        $_SESSION['tipo_mensagem'] = 'success';

                        header('Location: sistema-gemeos.php');
                    } else {
?>
                        <div class="col-md-4 mx-auto alert alert-warning">
                            <i class="fa-solid fa-bomb"></i> Conta Inativa!
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="col-md-4 mx-auto alert alert-warning">
                        <i class="fa-solid fa-circle-exclamation"></i> Senha Incorreta!
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-md-4 mx-auto alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> Conta não cadastrada!
                </div>
<?php
            }
        }
    }
}
?>