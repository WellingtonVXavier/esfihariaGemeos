</main>
<style>
    /* Estilo para remover a ordenação das listas */
    .titulo {
        color: #fdd738;
        font-family: papyrus;
    }

    .lista ul {
        list-style: none;
    }

    .lista li a {
        color: #fdd738;
    }

    .lista a {
        list-style: none;
    }

    .footer {
        background-color: #5b1a29;
    }
</style>
<footer class="footer mt-auto py-4 no-print">
    <div class="container text-center text-light">
        <div class="row">
            <div class="col-md-2">
                <h5 class="d-inline titulo">
                    Esfiharia Gêmeos
                </h5>
            </div>

            <div class="col-md-3 lista">
                <ul>
                    <li>
                        <h5><strong>Inicio</strong></h5>
                    </li>

                    <li>
                        <a href="./" class="mt-3 mb-3">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="./" class="mt-3 mb-3">
                            Pedidos
                        </a>
                    </li>
                    <li>
                        <a href="./" class="mt-3 mb-3">
                            Carrinho
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 lista">
                <ul>
                    <li>
                        <h5><strong>Sobre-nós</strong></h5>
                    </li>

                    <li>
                        <a href="./" class="mt-3 mb-3">
                            Informações da empresa
                        </a>
                    </li>

                    <li>
                        <a href="./" class="mt-3 mb-3">
                            Contato
                        </a>
                    </li>

                    <li>
                        <a href="./" class="mt-3 mb-3">
                            Blog
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 lista">
                <ul>
                    <li>
                        <h5><strong>Suporte</strong></h5>
                    </li>

                    <li>
                        <a href="./" class="mt-3 mb-3">
                            FAQ
                        </a>
                    </li>

                    <li>
                        <a href="./" class="mt-3 mb-3">
                            Telefone
                        </a>
                    </li>

                    <li>
                        <a href="./" class="mt-3 mb-3">
                            Chat
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-1 text-center mt-3">
                <div class="btn-group">
                    <a href="./" class="mt-3 mx-2 #5b1a29">
                        <i class="fab fa-twitter" style="color: #fdd738;"></i>
                    </a>

                    <a href="./" class="mt-3 mx-2">
                        <i class="fa-brands fa-square-facebook" style="color: #fdd738;"></i>
                    </a>

                    <a href="./" class="mt-3 mx-2">
                        <i class="fab fa-instagram" style="color: #fdd738;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<!-- Sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-start',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>
<?php
if (isset($_SESSION['mensagem'])) {
?>
    <script type="text/javascript">
        Toast.fire({
            icon: '<?php echo $_SESSION['tipo_mensagem']; ?>',
            title: '<?php echo $_SESSION['mensagem']; ?>'
        })
        console.log('teste')
    </script>
<?php
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo_mensagem']);
}
?>

<script type="text/javascript">
    function mostrarConfirmacaoDeletar(id) {
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Não será possível desfazer essa ação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, deletar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Faz uma chamada Ajax para excluir o produto
                $.ajax({
                    type: 'GET',
                    url: 'exclui-produto.php', 
                    data: {
                        id_produto: id
                    }, // Passa o ID do produto
                    success: function(response) {
                        Swal.fire(
                            'Deletado!',
                            `O produto ${id} foi deletado.`,
                            'success'
                            );
                            window.setTimeout(function(){
                                window.location.reload(true);
                            },2000)
                        },
                    error: function(xhr, status, error) {
                        console.error(error,status); // Exibe erros (opcional)
                    }
                });
            }
        });
    }
</script>
<script type="text/javascript">
    function mostrarConfirmacaoRemover(id) {
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Não será possível desfazer essa ação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, deletar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Faz uma chamada Ajax para excluir o produto
                $.ajax({
                    type: 'GET',
                    url: 'remover_do_carrinho.php', 
                    data: {
                        id_produto: id
                    }, // Passa o ID do produto
                    success: function(response) {
                        Swal.fire(
                            'Deletado!',
                            `O produto ${id} foi deletado.`,
                            'success'
                            );
                            window.setTimeout(function(){
                                window.location.reload(true);
                            },2000)
                        },
                    error: function(xhr, status, error) {
                        console.error(error,status); // Exibe erros (opcional)
                    }
                });
            }
        });
    }
</script>

<script type="text/javascript">
    function mostrarConfirmacaoResetar(id) {
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Não será possível desfazer essa ação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, resetar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Faz uma chamada Ajax para excluir o cliente
                $.ajax({
                    type: 'GET',
                    url: 'reseta-cliente.php', 
                    data: {
                        id_cliente: id
                    }, // Passa o ID do cliente
                    success: function(response) {
                        Swal.fire(
                            'Resetado!',
                            `A senha do cliente ${id} retornou para a senha padrão.`,
                            'success'
                            );
                            window.setTimeout(function(){
                                window.location.reload(true);
                            },2000)
                        },
                    error: function(xhr, status, error) {
                        console.error(error,status); // Exibe erros (opcional)
                    }
                });
            }
        });
    }
</script>


<!-- Script para área login funcionário -->
<script type="text/javascript" src="../js/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#CPF').mask('000.000.000-00');
    });
</script>

<!-- Script para área login cliente -->
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#CPF').mask('000.000.000-00');
    });
</script>
<!-- Script para área cadastro cliente -->
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#telefone').mask('(00) 00000-0000');
    });
</script>

<script type="text/javascript">
    // Seleciona o campo de entrada
    var input = document.getElementById("valor");

    // Adiciona um ouvinte de eventos de pressionamento de tecla
    input.addEventListener("keydown", function (e) {
        // Obtém o código da tecla pressionada
        var key = e.key || String.fromCharCode(e.keyCode);

        // Verifica se a tecla pressionada é um ponto '.'
        if (key === ',') {
            // Cancela o evento para impedir que o caractere '.' seja inserido
            e.preventDefault();
        }
    });
</script>


<script type="text/javascript">
    // Função para mostrar a foto nova de um produto
    function mostraImagem() {
        const imagem = document.getElementById('imagem');
        const mostra = document.getElementById('mostra_foto');
        const texto = document.getElementById('texto_nova_foto');

        if (imagem.files && imagem.files[0]) {
            const carrega = new FileReader();

            carrega.onload = function(e) {
                mostra.src = e.target.result;
                texto.style.display = 'block';
                texto.innerHTML += imagem.files[0].name;
            };
            carrega.readAsDataURL(imagem.files[0]);
        }
    }
</script>


</body>

</html>