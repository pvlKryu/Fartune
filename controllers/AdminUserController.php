<?php
class AdminUserController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin(); //Проверка доступа

        $users=array();
        $users=User::getUserList();

        require_once(ROOT.'/views/admin_user/customer/index.php');
        return true;
    }  

    public function actionIndexChoice()
    {
        self::checkAdmin(); //Проверка доступа

        require_once(ROOT.'/views/admin_user/index.php');

        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin(); //Проверка доступа

        $options['FIO']='';
        $options['number']='';
        $options['login']='';
        $options['password']='';

        if (isset($_POST['submit']))
        {
            $options['FIO']=$_POST['FIO'];
            $options['number']=$_POST['number'];
            $options['login']=$_POST['login'];
            $options['password']=$_POST['password'];

            $errors=false;
            
            if (!User::checkFIOLength($options['FIO'])) $errors[]='ФИО должен быть не меньше 3-х символов и не больше 50';
            if (!User::checkFIOSymbols($options['FIO'])) $errors[]='ФИО может состоять только из букв русского алфавита';

            if (!User::checkNumberLength($options['number'])) $errors[]='Номер должен состоять из 11 цифр';
            if (!User::checkNumberSymbols($options['number'])) $errors[]='Номер может состоять только из цифр';

            if (!User::checkLoginLength($options['login'])) $errors[]='Логин должен быть не меньше 3-х символов и не больше 30';
            if (!User::checkLoginSymbols($options['login'])) $errors[]='Логин может состоять только из букв английского алфавита и цифр';
            if (!User::checkLoginExists($options['login'])) $errors[]='Пользователь с таким логином уже существует';
            
            if (!User::checkPasswordLength($options['password'])) $errors[]='Пароль должен быть не меньше 3-х символов и не больше 32';

            if($errors==false) 
            {
                User::register($options['FIO'], $options['number'], $options['login'], $options['password']);
                header("Location: /admin/user/customer");
            }
        }

        require_once(ROOT.'/views/admin_user/customer/create.php');
        return true;
    }  

    public function actionUpdate($id)
    {
        self::checkAdmin(); //Проверка доступа

        $user=array();
        $user=User::getUserById($id);

        $FIO=$user['FIO'];
        $number=$user['number'];

        if (isset($_POST['submit']))
        {
            $FIO=$_POST['FIO'];
            $number=$_POST['number'];

            $errors=false;

            if (!User::checkFIOLength($FIO)) $errors[]='ФИО должен быть не меньше 3-х символов и не больше 50';
            if (!User::checkFIOSymbols($FIO)) $errors[]='ФИО может состоять только из букв русского алфавита';

            if (!User::checkNumberLength($number)) $errors[]='Номер должен состоять из 11 цифр';
            if (!User::checkNumberSymbols($number)) $errors[]='Номер может состоять только из цифр';


            if($errors==false) 
            {
                $result=User::editData($user['login'], $FIO, $number);
                header("Location: /admin/user/customer");
            }
        }

        require_once(ROOT.'/views/admin_user/customer/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin(); //Проверка доступа
        $user=User::getUserById($id);

        if(isset($_POST['submit']))
        {   
            User::deleteUserById($id);
            header("Location: /admin/user/customer");
        }

        require_once(ROOT.'/views/admin_user/customer/delete.php');
        return true;
    } 

    public function actionPassword($id)
    {
        self::checkAdmin(); //Проверка доступа
        $user=User::getUserById($id);

        $newPassword='';

        if(isset($_POST['submit']))
        {
            $newPassword=$_POST['newPassword'];

            $errors=false;

            if (!User::checkPasswordLength($newPassword)) $errors[]='Пароль должен быть не меньше 3-х символов и не больше 32';
            
            if($errors==false) 
            {
                User::editPassword($user['login'], $newPassword);
                header("Location: /admin/user/customer");
            }
        }

        require_once(ROOT.'/views/admin_user/customer/password.php');

        return true;
    }

    public function actionOrders($id)
    {
        self::checkAdmin(); //Проверка доступа
        $user=User::getUserById($id);

        $orders=User::getOrdersByUser($user['login']);

        require_once(ROOT.'/views/admin_user/customer/orders.php');

        return true;
    }
}
?>