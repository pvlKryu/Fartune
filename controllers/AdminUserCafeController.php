<?php
class AdminUserCafeController extends AdminBase
{
    public function actionIndex($cafe_id)
    {
        self::checkAdmin(); //Проверка доступа

        $cafe=Cafe::getCafeById($cafe_id);

        $cafeUserList=CafeUser::getCafeUserListByCafe($cafe_id);

        require_once(ROOT.'/views/admin_user/cafe_user/index.php');
        return true;
    }  

    public function actionIndexChoice()
    {
        self::checkAdmin(); //Проверка доступа

        $cafes=array();
        $cafes=Cafe::getCafeList();

        require_once(ROOT.'/views/admin_user/cafe_user/index_choice.php');
        return true;
    }  

    public function actionIndexAll()
    {
        self::checkAdmin(); //Проверка доступа

        $cafeUserList=CafeUser::getCafeUserList();

        require_once(ROOT.'/views/admin_user/cafe_user/indexAll.php');
        return true;
    }  

    public function actionCreate($cafe_id)
    {
        self::checkAdmin(); //Проверка доступа

        $options['login']='';
        $options['role']='';
        $options['password']='';

        $cafe=Cafe::getCafeById($cafe_id);

        $roleList=CafeUser::getRoleList();

        if (isset($_POST['submit']))
        {
            $options['login']=$_POST['login'];
            $options['role']=$_POST['role'];
            $options['password']=$_POST['password'];

            $errors=false;

            if (!User::checkLoginLength($options['login'])) $errors[]='Логин должен быть не меньше 3-х символов и не больше 30';
            if (!User::checkLoginSymbols($options['login'])) $errors[]='Логин может состоять только из букв английского алфавита и цифр';
            if (!CafeUser::checkLoginExists($options['login'])) $errors[]='Пользователь с таким логином уже существует';
            
            if (!User::checkPasswordLength($options['password'])) $errors[]='Пароль должен быть не меньше 3-х символов и не больше 32';


            if($errors==false)
            {
                CafeUser::register($options['login'], $options['role'], $options['password'], $cafe_id);
                header("Location: /admin/user/employee/{$cafe_id}");
            }
        }

        require_once(ROOT.'/views/admin_user/cafe_user/create.php');
        return true;
    }  

    public function actionUpdate($id)
    {
        self::checkAdmin(); //Проверка доступа

        $cafeUser=CafeUser::getCafeUserById($id);
        $cafe_id=$cafeUser['cafe_id'];

        $cafe=Cafe::getCafeById($cafe_id);

        $roleList=CafeUser::getRoleList();

        $role=$cafeUser['role'];

        if (isset($_POST['submit']))
        {
            $role=$_POST['role'];

            $errors=false;
            
            if($errors==false) 
            {
                $result=CafeUser::editData($id, $role);
                header("Location: /admin/user/employee/{$cafe_id}");
            }
        }

        require_once(ROOT.'/views/admin_user/cafe_user/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin(); //Проверка доступа

        $cafeUser=CafeUser::getCafeUserById($id);
        $cafe_id=$cafeUser['cafe_id'];

        if(isset($_POST['submit']))
        {   
            CafeUser::deleteCafeUserById($id);

            header("Location: /admin/user/employee/{$cafe_id}");
        }

        require_once(ROOT.'/views/admin_user/cafe_user/delete.php');
        return true;
    } 

    public function actionPassword($id)
    {
        self::checkAdmin(); //Проверка доступа
        $cafeUser=cafeUser::getCafeUserById($id);

        $newPassword='';

        if(isset($_POST['submit']))
        {
            $newPassword=$_POST['newPassword'];

            $errors=false;

            if (!User::checkPasswordLength($newPassword)) $errors[]='Пароль должен быть не меньше 3-х символов и не больше 32';
            
            if($errors==false) 
            {
                cafeUser::editPassword($id, $newPassword);
                header("Location: /admin/user/employee/{$cafe_id}");
            }
        }

        require_once(ROOT.'/views/admin_user/cafe_user/password.php');

        return true;
    }

}
?>