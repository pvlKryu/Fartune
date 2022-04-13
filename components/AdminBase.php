<?php
abstract class AdminBase
{
    public static function checkAdmin()
    {
        $userId=User::checkLogged();

        // $user=User::getUserByLogin($userId);
        // if($user['role']=='admin') return true;

        if (isset($_SESSION['role']) && $_SESSION['role']=='admin') return true;

        die('Доступ запрещен');
    }
}
?>