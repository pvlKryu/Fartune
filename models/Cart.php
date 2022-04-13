<?php
class cart
{
    // public static function addProduct($id)
    // {
    //     $id=intval($id);

    //     $productsInCart=array();

    //     if (isset($_SESSION['products'])) $productsInCart=$_SESSION['products'];

    //     if (array_key_exists($id, $productsInCart)) $productsInCart[$id]++;
    //     else $productsInCart[$id]=1;

    //     $_SESSION['products']=$productsInCart;
    // }

    // public static function removeProduct($id)
    // {
    //     $id=intval($id);

    //     $productsInCart=array();

    //     if (isset($_SESSION['products'])) $productsInCart=$_SESSION['products'];

    //     if (array_key_exists($id, $productsInCart)) 
    //     {
    //         if ($productsInCart[$id]>1) $productsInCart[$id]--;
    //         else unset($productsInCart[$id]);
    //     }

    //     $_SESSION['products']=$productsInCart;
    // }
    
    public static function addProductAjax($id)
    {
        $id=intval($id);

        $productsInCart=array();

        if (isset($_SESSION['products'])) $productsInCart=$_SESSION['products'];

        if (array_key_exists($id, $productsInCart)) $productsInCart[$id]++;
        else $productsInCart[$id]=1;

        $_SESSION['products']=$productsInCart;

        return $productsInCart[$id];
    }

    public static function removeProductAjax($id)
    {
        $id=intval($id);

        $productsInCart=array();

        if (isset($_SESSION['products'])) $productsInCart=$_SESSION['products'];

        if (array_key_exists($id, $productsInCart)) 
        {
            if ($productsInCart[$id]>1) $productsInCart[$id]--;
            else unset($productsInCart[$id]);
        }

        $_SESSION['products']=$productsInCart;

        if (isset($productsInCart[$id])) return $productsInCart[$id];
        else return 0;
    }

    public static function getProducts() //товары из корзины
    {
        if (isset($_SESSION['products'])) return $_SESSION['products'];
        return false;
    }

    public static function getTotalPrice($products) //итоговая сумма в корзине
    {
        $productsInCart=self::getProducts();

        if ($productsInCart)
        {
            $total=0;
            foreach ($products as $item)
            {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;
    }

    public static function save($products, $totalPrice) //сохранение заказа в БД
    {
        date_default_timezone_set('Asia/Vladivostok');
        $order_status="отправлено";
        $productsInCart=Cart::getProducts();
        $db=Db::getConnection();
        $dateToday=date("Y-m-d");

        $order_content=json_encode($products);

        $sql='INSERT INTO product_order(amount, time, date, user, cafe, status, content) VALUES (:amount,"'.$_SESSION['order_time'].'","'.$dateToday.'",:user,:cafe,:status,:content)';
        $result=$db->prepare($sql);
        $result->bindParam(':amount', $totalPrice, PDO::PARAM_INT);
        $result->bindParam(':user', $_SESSION['userlogin'], PDO::PARAM_STR);
        $result->bindParam(':cafe', $_SESSION['cafeorder'], PDO::PARAM_INT);
        $result->bindParam(':status', $order_status, PDO::PARAM_STR);
        $result->bindParam(':content', $order_content, PDO::PARAM_STR);
        
        return $result->execute();
    }

    public static function clear() //очистка корзины
    {
        if (isset($_SESSION['products'])) unset($_SESSION['products']);
        if (isset($_SESSION['order_time'])) unset($_SESSION['order_time']);
        if (isset($_SESSION['cafeorder'])) unset($_SESSION['cafeorder']);
    }
}
?>