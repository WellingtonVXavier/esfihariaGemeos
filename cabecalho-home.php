<?php
session_start();



?>

<!DOCTYPE html>
<html lang="pt-br" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esfiharia Gêmeos</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Personalizado -->
    <style type="text/css">
        .print {
            display: none;
            padding-bottom: 20px;
        }

        .foto-impressao {
            max-height: 200px;
        }

        @media only print {
            main {
                position: absolute;
                margin: 1cm;
            }

            .no-print {
                visibility: hidden;
            }

            .print {
                display: block !important;
            }

            #print td,
            #print th {
                border: none !important;
            }
        }
    </style>

</head>

<body class="h-100 d-flex flex-column">
    <h3 class="alert text-center shadow no-print mb-0" style="background-color: #5b1a29 !important; color: rgba(0,0,0,255); border: none;">
        <a href="./" style="text-decoration: none; color: #FDD738; font-family: papyrus"><i class="fa-solid fa-fire-flame-curved" style="color: #FDD738;"></i>Esfiharia Gêmeos</a>

        <?php
        if (!isset($_SESSION['Id'])) {
        ?>
            <div class="dropdown dropleft" style="float: right">
                <button class="btn" type="button" id="dropdownMenuButton" style="color: #b34c2a; background-color: #5b1a29 ;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <a href="#"><i class="fa-solid fa-cart-shopping mt-1" style="color: #FDD738; float: right"></i></a>
                </button>
                <div class="dropdown-menu" style="width: 200px">
                    <form class="px-2 py-1" action="login.php" method="post">
                        <div class="form-group">
                            <label for="login">CPF</label>
                            <input type="text" class="form-control" id="login" placeholder="000.000.000-00" name="login">
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 btn-block">Entrar</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-center" href="cadastro.php">Cadastre-se agora!</a>
                </div>
            </div>

        <?php
        } else {
        ?>
            <div class="float-right">
                <div class="btn-group dropleft">
                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #5b1a29 ;">
                        <i class="fa-solid fa-bars" style="color: #fdd738;"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item mt-2" href="carrinho.php"><i class="fa-solid fa-cart-shopping mt-1" style="color: #fdd738;"></i> Carrinho</a>
                        <a class="dropdown-item mt-2" href="novo-pedido.php"><i class="fa-solid fa-cart-plus" style="color: #fdd738;"></i> Novo Pedido</a>
                        <a class="dropdown-item mt-2" href="meus-pedidos.php"><i class="fa-solid fa-pen-to-square" style="color: #fdd738;"></i> Meus Pedidos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php" style="color: #c40e0e" title="Voltar"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #c40e0e"></i> Sair</a>

                    </div>
                </div>

            </div>



        <?php
        }
        ?>


    </h3>
    <!-- <a href="./" class=""><i class="fa-solid fa-house" style="color: #b34c2a; ;"></i> Home</a> -->
    <?php
    include_once "banner.php";
    include_once "cardapio.php";
    include_once "sobre.php";
    ?>

    <main class="container mt-auto" style="background-color: #5b1a29;">