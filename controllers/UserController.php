<?php
class UserController
{
    public function actionRegister()
    {
        if(isset($_SESSION['userlogin'])) header("Location: /");

        $FIO='';
        $number='';
        $login='';
        $password='';
        $result=false;

        if(isset($_POST['submit']))
        {
            $FIO=$_POST['FIO'];
            $number=$_POST['number'];
            $login=$_POST['login'];
            $password=$_POST['password'];

            $errors = false;

            if (!User::checkFIOLength($FIO)) $errors[]='ФИО должен быть не меньше 3-х символов и не больше 50';
            if (!User::checkFIOSymbols($FIO)) $errors[]='ФИО может состоять только из букв русского алфавита';

            if (!User::checkNumberLength($number)) $errors[]='Номер должен состоять из 11 цифр';
            if (!User::checkNumberSymbols($number)) $errors[]='Номер может состоять только из цифр';

            if (!User::checkLoginLength($login)) $errors[]='Логин должен быть не меньше 3-х символов и не больше 30';
            if (!User::checkLoginSymbols($login)) $errors[]='Логин может состоять только из букв английского алфавита и цифр';
            if (!User::checkLoginExists($login)) $errors[]='Пользователь с таким логином уже существует';
            
            if (!User::checkPasswordLength($password)) $errors[]='Пароль должен быть не меньше 3-х символов и не больше 32';

            if($errors==false) $result=User::register($FIO, $number, $login, $password);

            if($result) 
            { 
                User::auth($login);
                header("Location: /");
            }
        }

        require_once(ROOT.'/views/user/register.php');

        return true;
    }

    public function actionChoice()
    {
        if(isset($_SESSION['userlogin'])) header("Location: /");

        require_once(ROOT.'/views/user/login.html');

        return true;
    }

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

    public function actionLogin()
    {
        if(isset($_SESSION['userlogin'])) header("Location: /");

        $login='';
        $password='';

        if(isset($_POST['submit']))
        {
            $login=$_POST['login'];
            $password=$_POST['password'];

            $errors=false;

            //Проверка полей
            if (!User::checkLoginLength($login)) $errors[]='Логин должен быть не меньше 3-х символов и не больше 30';
            if (!User::checkLoginSymbols($login)) $errors[]='Логин может состоять только из букв английского алфавита и цифр';
            
            if (!User::checkPasswordLength($password)) $errors[]='Пароль должен быть не меньше 3-х символов и не больше 32';

            //Проверка логина и пароля
            $userLogin=User::checkUserData($login, $password);

            if ($userLogin==false) $errors[]='Вы ввели неправильный логин/пароль';
            else 
            {
                //Запоминаем в сессии
                User::auth($userLogin);

                //Проверка на админа
                User::checkRole($userLogin);

                //Переадресовываем
                header("Location: /");
                //exit("<meta http-equiv='refresh' content='0; url= /index.php/cabinet'>");
            }
        }

        require_once(ROOT.'/views/user/login_user.php');

        return true;
    }

    public function actionLogout()
    {
        session_destroy();
        //unset($_SESSION["userlogin"]);

        header("Location: /");
        //exit("<meta http-equiv='refresh' content='0; url= /'>");
    }
}
?>