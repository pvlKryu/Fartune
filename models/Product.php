<?php
class Product
{
    public static function getProductById($id)
    {
        $db=Db::getConnection();
        $result = $db->query("SELECT * FROM cafe_products WHERE id='$id'");

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function getProductsListByCafe($cafeId = false)
    {
        if ($cafeId)
        {
            $db=Db::getConnection();
            $products=array();
            $result = $db->query("SELECT id, name, price, description FROM cafe_products WHERE cafe_id='$cafeId'");

            $i=0; $j=0;
            while($row=$result->fetch())
            {
                $products[$i][$j]['id']=$row['id'];
                $products[$i][$j]['name']=$row['name'];
                $products[$i][$j]['price']=$row['price'];
                $products[$i][$j]['description']=$row['description'];
                $j++;
                if ($j==6) 
                {
                    $j=0;
                    $i++;
                }
            }

            return $products;
        }
    }

    public static function getProductsByIds($idsArray)
    {
        $products=array();

        $db=Db::getConnection();

        $idsString=implode(',',$idsArray);

        $sql = "SELECT * FROM cafe_products WHERE id IN ($idsString) ORDER BY cafe_id, id";

        $result=$db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC); //результат в виде массива

        $i=0;
        while ($row = $result->fetch())
        {
            $products[$i]['id']=$row['id'];
            $products[$i]['name']=$row['name'];
            $products[$i]['cafe_id']=$row['cafe_id'];
            $products[$i]['price']=$row['price'];
            $cafe=Cafe::getCafeById($row['cafe_id']);
            $products[$i]['cafe_name']=$cafe['name'];
            $i++;
        }

        return $products;
    }

    public static function deleteProductById($id)
    {
        //удаление существующего файла (картинки)
        $existimage=Product::getImage($id);
        if ($existimage!='/upload/images/products/no-image.jpg')
            unlink($_SERVER['DOCUMENT_ROOT']."{$existimage}");

        $db=Db::getConnection();

        //Перемещение в таблицу удаленных
        $product = Product::getProductById($id);
        $product['name'] = $product['name']." (удален)";
        $sql = "INSERT INTO cafe_products_delete(id, name, cafe_id, price, description) VALUES (:id,:name,:cafe_id,:price,:description)";

        $result=$db->prepare($sql);
        $result->bindParam(':id', $product['id'], PDO::PARAM_INT);
        $result->bindParam(':name', $product['name'], PDO::PARAM_STR);
        $result->bindParam(':cafe_id', $product['cafe_id'], PDO::PARAM_INT);
        $result->bindParam(':price', $product['price'], PDO::PARAM_INT);
        $result->bindParam(':description', $product['description'], PDO::PARAM_STR);
        $result->execute();

        //Удаление товаров из таблицы существующих
        $sql = "DELETE FROM cafe_products WHERE id = :id";

        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function createProduct($options)
    {
        $db=Db::getConnection();

        $sql = "INSERT INTO cafe_products(name, cafe_id, price, description) VALUES (:name,:cafe_id,:price,:description)";

        $result=$db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':cafe_id', $options['cafe_id'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);

        if ($result->execute()) return $db->lastInsertId();

        return 0;
    }

    public static function updateProductById($id,$options)
    {
        $db=Db::getConnection();

        $sql = "UPDATE cafe_products SET name=:name,cafe_id=:cafe_id,price=:price,description=:description WHERE id=:id";

        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':cafe_id', $options['cafe_id'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getImage($id)
    {
        $noImage='no-image.jpg';

        $path='/upload/images/products/';

        $pathToProductImage=$path.$id.'.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage))
            return $pathToProductImage;
        
        $pathToProductImage=$path.$id.'.svg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage))
            return $pathToProductImage;

        $pathToProductImage=$path.$id.'.jpeg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage))
            return $pathToProductImage;

        return $path.$noImage;
    }

    public static function getDeletedProductsByIds($idsArray)
    {
        $products=array();

        $db=Db::getConnection();

        $idsString=implode(',',$idsArray);

        $sql = "SELECT * FROM cafe_products_delete WHERE id IN ($idsString) ORDER BY cafe_id, id";

        $result=$db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC); //результат в виде массива

        $i=0;
        while ($row = $result->fetch())
        {
            $products[$i]['id']=$row['id'];
            $products[$i]['name']=$row['name'];
            $products[$i]['cafe_id']=$row['cafe_id'];
            $products[$i]['price']=$row['price'];
            $cafe=Cafe::getCafeById($row['cafe_id']);
            if($cafe) $products[$i]['cafe_name']=$cafe['name'];
            else 
            {
                $cafe=Cafe::getDeletedCafeById($row['cafe_id']);
                $products[$i]['cafe_name']=$cafe['name'];
            }
            $i++;
        }

        return $products;
    }

    public static function getAllProducts()
    {
        $db=Db::getConnection();
        $products=array();
        $result = $db->query("SELECT id, name, price, description, cafe_id FROM cafe_products WHERE 1");

        $i=0; $j=0;
        while($row=$result->fetch())
        {
            $products[$i][$j]['id']=$row['id'];
            $products[$i][$j]['name']=$row['name'];
            $products[$i][$j]['price']=$row['price'];
            $products[$i][$j]['description']=$row['description'];
            $cafe=Cafe::getCafeById($row['cafe_id']);
            $products[$i][$j]['cafe']=$cafe['name'];
            $j++;
            if ($j==6) 
            {
                $j=0;
                $i++;
            }
        }

        return $products;
    }
}
?>