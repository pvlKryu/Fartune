<?php
class CabinetController
{
    public function actionIndex()
    {
        $userLogin=User::checkLogged();

        $user=User::getUserByLogin($userLogin);

        require_once(ROOT.'/views/cabinet/index.php');

        return true;
    }

    public function actionEdit()
    {
        $userLogin=User::checkLogged();
        $user=User::getUserByLogin($userLogin);

        $FIO=$user['FIO'];
        $number=$user['number'];

        $result=false;

        if(isset($_POST['submit']))
        {
            $FIO=$_POST['FIO'];
            $number=$_POST['number'];

            $errors=false;

            if (!User::checkFIOLength($FIO)) $errors[]='ФИО должен быть не меньше 3-х символов и не больше 50';
            if (!User::checkFIOSymbols($FIO)) $errors[]='ФИО может состоять только из букв русского алфавита';

            if (!User::checkNumberLength($number)) $errors[]='Номер должен состоять из 11 цифр';
            if (!User::checkNumberSymbols($number)) $errors[]='Номер может состоять только из цифр';


            if($errors==false) $result=User::editData($userLogin, $FIO, $number);
        }

        require_once(ROOT.'/views/cabinet/edit_data.php');

        return true;
    }
    public function actionEditPassword()
    {
        $userLogin=User::checkLogged();
        $user=User::getUserByLogin($userLogin);

        $password=$user['password'];
        $newPassword='';
        $checkPassword='';

        $result=false;

        if(isset($_POST['submit']))
        {
            $newPassword=$_POST['newPassword'];
            $checkPassword=$_POST['checkPassword'];

            $errors=false;

            if (!User::checkPasswordLength($newPassword) or !User::checkPasswordLength($checkPassword)) $errors[]='Пароль должен быть не меньше 3-х символов и не больше 32';
            if (md5(md5(trim($checkPassword)))!=$password) $errors[]='Пароль не совпадает';

            if($errors==false) $result=User::editPassword($userLogin, $newPassword);
        }

        require_once(ROOT.'/views/cabinet/edit_password.php');

        return true;
    }

    public function actionOrders()
    {
        $userLogin=User::checkLogged();

        if ($userLogin)
        {
            $orders=User::getOrdersByUser($userLogin);

            require_once(ROOT.'/views/cabinet/user_orders.php');
        }

        return true;
    }
}
?>