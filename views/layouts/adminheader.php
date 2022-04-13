<!DOCTYPE html>
<html lang="ru">
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/template/images/web_logo.png" type="image/png">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/template/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>
        Faturne  
    </title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
        -->

    <div style="background: #FFF850;">
    <header class="header"> 
            <div class="logo">
                <a href="/"><img src="\template\images\logo.jpg" width="142" height="" alt="logo" class="cofee_logo"></a>
            </div>

            <nav class="nav1">
                <button class="buttons">
                    <p><a class="buttons-text" href="/admin">Админпанель</a></p>
                </button>

                <?php
                    if(isset($_SESSION['userlogin'])) echo '
                        <button class="buttons">
                            <p><a class="buttons-text" href="/logout">Выйти</a></p>
                        </button>
                        ';
                    else echo '
                    <button class="buttons">
                        <p><a class="buttons-text" href="/login">Войти</a></p>
                    </button>
                    ';
                ?>
            </nav>
        </header>
    </div>