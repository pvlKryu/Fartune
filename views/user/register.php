<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/template/images/web_logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/template/css/register.css">
    <title>Faturne - Регистрация</title>
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
                   Регистрация
               </h1>
               <form class="reg-form" method="POST">
                    <fieldset class=reg-form__wrap>
                        <ul class="reg-form__info">
                           <li>
                                <label for="n">ФИО:</label> <input name="FIO" type="text" class="reg-form__field" value="<?php echo $FIO; ?>" required>
                            </li>
                            <li>
                                <label for="ln">Номер телефона:</label> <input name="number" type="text" class="reg-form__field" value="<?php echo $number; ?>" required>
                            </li>
                            <li>
                                <label for="in">Логин:</label> <input name="login" type="text" class="reg-form__field" value="<?php echo $login; ?>" required>
                            </li>
                            <li>     
                                <label for="an">Пароль:</label> <input name="password" type="password" class="reg-form__field" value="<?php echo $password; ?>" required>
                            </li>
                            <li>     
                               <input name="submit" type="submit" class="reg-form__submit" value="Зарегистрироваться">
                            </li>
                        </ul>
                    </fieldset>
                </form>

                
                <?php if (isset($errors) && is_array($errors)): ?>
                    <b>При регистрации произошли следующие ошибки:</b><br>
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