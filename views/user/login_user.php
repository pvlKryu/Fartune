<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/template/images/web_logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/template/css/login_user.css">
    <title>Вход в аккаунт клиента</title>
</head>
<body>
    <header class="header">
        <div class="wrapper">
            <div class="header__wrapper">
                <div class="header__logo">
                    <a href="/login" class="header__logo-link">
                        <img src="/template/images/Logo2.svg" alt="Faturn - Добро пожаловать!" class="header__logo-pic">
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <section class="intro">
           <div class="wrapper">
               <h1 class="intro_title">
                   Вход в аккаунт
               </h1>
               <form class="log-form" method="POST">
                    <fieldset class=log-form__wrap>
                        <ul class="log-form__info">
                           <li>
                                <label for="n">Логин</label> <input name="login" type="text" class="log-form__field" value="<?php echo $login; ?>" required>
                            </li>
                            <li>
                                <label for="ln">Пароль</label> <input name="password" type="password" class="log-form__field" value="<?php echo $password; ?>" required>
                            </li>
                            <li>     
                               <input name="submit" type="submit" class="log-form__submit" value="Войти">
                            </li>
                        </ul>
                        <p class="log-form_subtitle">
                            <a href="/" class="log-form__pick-link">
                                Зайти без авторизации <img src="/template/images/galochka.svg" width="35px"class="log-form__picture">
                            </a>
                        </p>
                    </fieldset>
                </form>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <br><b>При входе произошли следующие ошибки:</b><br>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?> </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif ?>

           </div> 
        </section>
    </main>
</body>
</html>