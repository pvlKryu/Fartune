<?php
class Cafe
{
    public static function getCafeList()
    {
        $db = Db::getConnection();

        $cafeList = array();

        $result = $db->query('SELECT id, login, status, address FROM cafe');

        $i=0; $j=0;
        while ($row=$result->fetch())
        {
            $cafeList[$i][$j]['id']=$row['id'];
            $cafeList[$i][$j]['login']=$row['login'];
            $cafeList[$i][$j]['status']=$row['status'];
            $cafeList[$i][$j]['address']=$row['address'];
            $j++;
            if ($j==2) 
            {
                $j=0;
                $i++;
            }
        }

        return $cafeList;
    }
    public static function getCafeById($cafeId = false)
    {
        if ($cafeId)
        {
            $db=Db::getConnection();
            $cafe=array();
            $result = $db->query("SELECT login, status, address FROM cafe WHERE id='$cafeId'");

            while($row=$result->fetch())
            {
                $cafe['name']=$row['login'];
                $cafe['status']=$row['status'];
                $cafe['address']=$row['address'];
                $cafe['id']=$cafeId;
            }

            return $cafe;
        }
    }

    public static function getCafeByProductId($productId = false)
    {
        if ($productId)
        {
            $db=Db::getConnection();
            $result = $db->query("SELECT cafe_id FROM cafe_products WHERE id='$productId'");

            $row=$result->fetch();
            $cafeId=$row['cafe_id'];

            return $cafeId;
        }
    }

    public static function getCafeListAdmin()
    {
        $db = Db::getConnection();

        $cafeList = array();

        $result = $db->query('SELECT id, login FROM cafe ORDER BY login');

        $i=0;
        while ($row=$result->fetch())
        {
            $cafeList[$i]['id']=$row['id'];
            $cafeList[$i]['login']=$row['login'];
            $i++;
        }

        return $cafeList;
    }

    public static function deleteCafeById($id)
    {
        $db=Db::getConnection();

        //Удаление товаров (перемещение в таблицу удаленных)
        $products=Product::getProductsListByCafe($id);
        foreach($products as $pr)
        foreach ($pr as $product)
        {
            Product::deleteProductById($product['id']);
        }

        //Удаление работников и админа
        $sql = "DELETE FROM cafe_users WHERE cafe_id = :cafe_id";
        $result=$db->prepare($sql);
        $result->bindParam(':cafe_id', $id, PDO::PARAM_INT);
        $result->execute();

        //Перемещение кафе в таблицу удаленных
        $cafe=Cafe::getCafeById($id);
        $cafe['name']=$cafe['name']." (удалено)";
        $sql = "INSERT INTO cafe_delete(id, login, status, address) VALUES (:id, :login, :status, :address)";

        $result=$db->prepare($sql);
        $result->bindParam(':id', $cafe['id'], PDO::PARAM_INT);
        $result->bindParam(':login', $cafe['name'], PDO::PARAM_STR);
        $result->bindParam(':status', $cafe['status'], PDO::PARAM_STR);
        $result->bindParam(':address', $cafe['address'], PDO::PARAM_STR);
        $result->execute();

        //удаление существующего файла (картинки)
        $existimage=Cafe::getImage($id);
        if ($existimage!='/upload/images/cafe/no-image.jpg')
            unlink($_SERVER['DOCUMENT_ROOT']."{$existimage}");

        //Удаление кафе из таблицы существующих
        $sql = "DELETE FROM cafe WHERE id = :id";
        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function createCafe($options)
    {
        $db=Db::getConnection();

        $sql = "INSERT INTO cafe(login, status, address) VALUES (:login, :status, :address)";

        $result=$db->prepare($sql);
        $result->bindParam(':login', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_STR);
        $result->bindParam(':address', $options['address'], PDO::PARAM_STR);

        if ($result->execute()) return $db->lastInsertId();

        return 0;
    }

    public static function updateCafeById($id,$options)
    {
        $db=Db::getConnection();

        $sql = "UPDATE cafe SET login=:login,status=:status,address=:address WHERE id=:id";

        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':login', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_STR);
        $result->bindParam(':address', $options['address'], PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getImage($id)
    {
        $noImage='no-image.jpg';

        $path='/upload/images/cafe/';

        $pathToCafeImage=$path.$id.'.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToCafeImage))
            return $pathToCafeImage;
        
        $pathToCafeImage=$path.$id.'.svg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToCafeImage))
            return $pathToCafeImage;

        $pathToCafeImage=$path.$id.'.jpeg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToCafeImage))
            return $pathToCafeImage;

        return $path.$noImage;
    }

    public static function getDeletedCafeById($cafeId = false)
    {
        if ($cafeId)
        {
            $db=Db::getConnection();
            $cafe=array();
            $result = $db->query("SELECT login, status, address FROM cafe_delete WHERE id='$cafeId'");

            while($row=$result->fetch())
            {
                $cafe['name']=$row['login'];
                $cafe['status']=$row['status'];
                $cafe['address']=$row['address'];
                $cafe['id']=$cafeId;
            }

            return $cafe;
        }
    }
}
?>