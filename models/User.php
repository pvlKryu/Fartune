<?php
class User
{
    public static function register($FIO, $number, $login, $password) 
    {
        // Убираем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($password)));
        $role = "user";
            
        $db=Db::getConnection();

        $sql='INSERT INTO users SET login=:login, password=:password, number=:number, FIO=:FIO, role=:role';

        $result=$db->prepare($sql);
        $result->bindParam(':FIO', $FIO, PDO::PARAM_STR);
        $result->bindParam(':number', $number, PDO::PARAM_STR);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':role', $role, PDO::PARAM_STR);
        
        return $result->execute();   
    }

    //Проверка заполнения формы регистрации
    public static function checkFIOLength($FIO)
    {
        if (mb_strlen($FIO) < 3 or mb_strlen($FIO) > 50) return false;
        else return true;
    }
    public static function checkFIOSymbols($FIO)
    {
        if (!preg_match('/[a-zA-Zа-яА-Я]+/ui', $FIO)) return false;
        else return true;
    }

    public static function checkNumberLength($number)
    {    
        if(!(strlen($number) == 11)) return false;
        else return true;
    }
    public static function checkNumberSymbols($number)
    {
        if(!preg_match("/^[0-9 ]+$/", $number)) return false;
        return true;
    }

    public static function checkLoginLength($login)
    {
        if(strlen($login) < 3 or strlen($login) > 30) return false;
        else return true;
    }
    public static function checkLoginSymbols($login)
    {
        if(!preg_match("/^[a-zA-Z0-9]+$/",$login)) return false;
        return true;
    }
    public static function checkLoginExists($login)
    {
        $db=Db::getConnection();

        $sql='SELECT COUNT(*) FROM users WHERE login = :login';

        $result=$db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn()) return false;
        return true;
    }

    public static function checkPasswordLength($password)
    {
        if(strlen($password) < 3 or strlen($password) > 32) return false;
        else return true;
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

    public static function getUserByLogin($login)
    {
        if($login)
        {
            $db=Db::getConnection();
            $sql='SELECT * FROM users WHERE login = :login';

            $result=$db->prepare($sql);
            $result->bindParam(':login', $login, PDO::PARAM_STR);

            $result->setFetchMode(PDO::FETCH_ASSOC); //результат в виде массива
            $result->execute();

            return $result->fetch();
        }
    }

    public static function getUserById($id)
    {
        if($id)
        {
            $db=Db::getConnection();
            $sql='SELECT * FROM users WHERE id = :id';

            $result=$db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_STR);

            $result->setFetchMode(PDO::FETCH_ASSOC); //результат в виде массива
            $result->execute();

            return $result->fetch();
        }
    }

    public static function editData($userLogin, $FIO, $number)
    {       
        $db=Db::getConnection();

        $sql='UPDATE users SET number=:number, FIO=:FIO WHERE login=:login';

        $result=$db->prepare($sql);
        $result->bindParam(':FIO', $FIO, PDO::PARAM_STR);
        $result->bindParam(':number', $number, PDO::PARAM_STR);
        $result->bindParam(':login', $userLogin, PDO::PARAM_STR);
        
        return $result->execute();   
    }
    public static function editPassword($userLogin, $password)
    {
        // Убираем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($password)));
            
        $db=Db::getConnection();

        $sql='UPDATE users SET password=:password WHERE login=:login';

        $result=$db->prepare($sql);
        $result->bindParam(':login', $userLogin, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result->execute();   
    }

    public static function getOrdersByUser($user)
    {
        $orders=array();

        $db=Db::getConnection();

        $result = $db->query("SELECT id, amount, time, date, cafe, status, content FROM product_order WHERE user='$user'");

        $i=0;
        while($row=$result->fetch())
        {
            $orders[$i]['id']=$row['id'];
            $orders[$i]['amount']=$row['amount'];
            $orders[$i]['time']=$row['time'];
            $orders[$i]['date']=$row['date'];
            $orders[$i]['cafe']=$row['cafe'];
            $orders[$i]['status']=$row['status'];
            $orders[$i]['content']=$row['content'];
            $i++;
        }

        return $orders;
    }

    public static function getUserList()
    {
        $db = Db::getConnection();

        $userList = array();

        $result = $db->query('SELECT id, login, FIO, number, role FROM users');

        $i=0;
        while ($row=$result->fetch())
        {
            $userList[$i]['id']=$row['id'];
            $userList[$i]['login']=$row['login'];
            $userList[$i]['FIO']=$row['FIO'];
            $userList[$i]['number']=$row['number'];
            $userList[$i]['role']=$row['role'];
            $i++;
        }

        return $userList;
    }

    public static function deleteUserById($id)
    {
        $db=Db::getConnection();

        //Удаление
        $sql = "DELETE FROM users WHERE id = :id";
        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}
?>