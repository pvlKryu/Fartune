<?php
class CafeUser
{
    public static function register($login, $role, $password, $cafe_id) 
    {
        // Убираем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($password)));
            
        $db=Db::getConnection();

        $sql='INSERT INTO cafe_users SET login=:login, password=:password, role=:role, cafe_id=:cafe_id';

        $result=$db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':role', $role, PDO::PARAM_STR);
        $result->bindParam(':cafe_id', $cafe_id, PDO::PARAM_STR);
        
        return $result->execute();   
    }

    public static function checkLoginExists($login)
    {
        $db=Db::getConnection();

        $sql='SELECT COUNT(*) FROM cafe_users WHERE login = :login';

        $result=$db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn()) return false;
        return true;
    }

    public static function checkUserData($login, $password)
    {
        $db=Db::getConnection();

        $password=md5(md5($password));

        $sql='SELECT * FROM users WHERE login = :login AND password = :password';

        $result=$db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user=$result->fetch();

        if($user) return $user['login'];
        return false;
    }

    public static function auth($userLogin)
    {
        $_SESSION['userlogin'] = $userLogin;
    }

    public static function checkLogged()
    {
        if(isset($_SESSION['userlogin'])) return $_SESSION['userlogin'];

        header("Location: /login");
    }

    public static function checkRole($userLogin)
    {
        $user=User::getUserByLogin($userLogin);
        if ($user['role'] == 'admin') $_SESSION['role']=$user['role'];

        return true;
    }

    public static function getCafeUserById($id)
    {
        if($id)
        {
            $db=Db::getConnection();
            $sql='SELECT * FROM cafe_users WHERE id = :id';

            $result=$db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_STR);

            $result->setFetchMode(PDO::FETCH_ASSOC); //результат в виде массива
            $result->execute();

            return $result->fetch();
        }
    }

    public static function editData($id, $role)
    {       
        $db=Db::getConnection();

        $sql='UPDATE cafe_users SET role=:role WHERE id=:id';

        $result=$db->prepare($sql);
        $result->bindParam(':role', $role, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        
        return $result->execute();   
    }
    public static function editPassword($id, $password)
    {
        // Убираем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($password)));
            
        $db=Db::getConnection();

        $sql='UPDATE cafe_users SET password=:password WHERE id=:id';

        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result->execute();   
    }

    public static function getCafeUserList()
    {
        $db = Db::getConnection();

        $cafeUserList = array();

        $result = $db->query('SELECT id, login, cafe_id, role FROM cafe_users');

        $i=0;
        while ($row=$result->fetch())
        {
            $cafeUserList[$i]['id']=$row['id'];
            $cafeUserList[$i]['login']=$row['login'];
            $cafeUserList[$i]['cafe_id']=$row['cafe_id'];
            $cafeUserList[$i]['role']=$row['role'];
            $i++;
        }
        return $cafeUserList;
    }

    public static function getCafeUserListByCafe($cafe_id = false)
    {
        if ($cafe_id)
        {
            $db = Db::getConnection();
            $cafeUserList = array();
            $result= $db->query("SELECT id, login, role FROM cafe_users WHERE cafe_id='$cafe_id'");

            $i=0;
            while ($row=$result->fetch())
            {
                $cafeUserList[$i]['id']=$row['id'];
                $cafeUserList[$i]['login']=$row['login'];
                $cafeUserList[$i]['role']=$row['role'];
                $i++;
            }
            return $cafeUserList;
        }
    }

    public static function deleteCafeUserById($id)
    {
        $db=Db::getConnection();

        //Удаление
        $sql = "DELETE FROM cafe_users WHERE id = :id";
        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getRoleList()
    {
        $roleList=array('barista','cafe_admin');

        return $roleList;
    }
}
?>