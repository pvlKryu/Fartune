<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/template/images/web_logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/template/css/login_cafe.css">
    <title>Вход в аккаунт кафетерия</title>
</head>
<body>
    <header class="header">
        <div class="wrapper">
            <div class="header__wrapper">
                <div class="header__logo">
                    <a href="login.html" class="header__logo-link">
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
                            <label for="n">Код кофетерия</label> <input name="login" type="text" class="log-form__field" required>
                            </li>
                            <li>
                                <label for="ln">Статус работника</label> <input name="status" type="text" class="log-form__field" required>
                            </li>
                            <li>     
                               <button name="submit" type="submit" class="log-form__submit">Войти</button>
                            </li>
                        </ul>
                    </fieldset>
                </form>

                <?php
                    // Функция для генерации случайной строки
                    function generateCode($length=6) 
                    {
                        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
                        $code = "";
                        $clen = strlen($chars) - 1;
                        while (strlen($code) < $length) {
                            $code .= $chars[mt_rand(0,$clen)];
                            }
                        return $code;
                    }

                    // Соединение с БД
                    //$link=mysqli_connect("localhost", "p99917v2_bd", "Y3JpQyIV", "p99917v2_bd");

                    if(isset($_POST['submit']))
                    {
                        // Вытаскиваем из БД запись, у которой логин равняеться введенному
                        $query = mysqli_query($link,"SELECT user_id, user_status FROM users_kofe WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
                        $data = mysqli_fetch_assoc($query);

                        // Сравниваем пароли
                        if($data['user_status'] === $_POST['status'])
                        {
                            // Генерируем случайное число и шифруем его
                            $hash = md5(generateCode(10));

                            // Записываем в БД новый хеш авторизации
                            mysqli_query($link, "UPDATE users_kofe SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");

                            //Сохраняем в сессии
                            $_SESSION['userid_kafe'] = $data['user_id'];
                            $_SESSION['hash_kafe'] = $hash;
                            //session_write_close();

                            // Переадресовываем
                            exit("<meta http-equiv='refresh' content='0; url= /views/product_order/product_order.php'>");
            
                        }
                        else
                        {
                            print "Вы ввели неправильный логин/статус";
                        }
                    }
                ?>
           </div> 
        </section>
    </main>
</body>
</html>