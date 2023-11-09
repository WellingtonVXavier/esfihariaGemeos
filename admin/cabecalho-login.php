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
        <a href="../" style="text-decoration: none; color: #FDD738; font-family: papyrus"><i class="fa-solid fa-fire-flame-curved" style="color: #FDD738;"></i>Esfiharia Gêmeos</a>
    </h3>


    <main class="container mt-auto">