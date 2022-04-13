<?php
class AdminController extends AdminBase
{
    public function actionIndex()
    {
        $userId=User::checkLogged();

        $user=User::getUserByLogin($userId);

        self::checkAdmin(); //Проверка доступа

        require_once(ROOT.'/views/admin/index.php');
        return true;
    }  
}
?>