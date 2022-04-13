<?php
class CartController
{
    // public function actionAdd($id)
    // {
    //     Cart::addProduct($id);

    //     $referrer=$_SERVER['HTTP_REFERER'];
    //     header("Location: $referrer#catalog");
    // }

    // public function actionRemove($id)
    // {
    //     Cart::removeProduct($id);

    //     $referrer=$_SERVER['HTTP_REFERER'];
    //     header("Location: $referrer#catalog");
    // }

    public function actionAddAjax($id)
    {
        //если клиент авторизован
        if(isset($_SESSION['userlogin'])) 
        {
            $cafeId=Cafe::getCafeByProductId($id);
            if(isset($_SESSION['cafeorder'])) 
            {
                if ($_SESSION['cafeorder'] != $cafeId) //если клиент заказывает с другого кафе
                {
                    echo '<script type="text/javascript">
                        alert("Заказ можно делать только в одном кафе");
                        </script>';
                    if (isset($_SESSION['products'][$id])) echo $_SESSION['products'][$id];
                    else echo 0;
                    return true;
                }
            }
            else $_SESSION['cafeorder']=$cafeId;

            echo Cart::addProductAjax($id);
            return true;
        }
        else //если клиент не авторизован
        {
            echo '<script type="text/javascript">
                alert("Перед покупкой зайдите в аккаунт");
                </script>';
            if (isset($_SESSION['products'][$id])) echo $_SESSION['products'][$id];
            else echo 0;
            return true;
        }
    }

    public function actionRemoveAjax($id)
    {
        //если клиент авторизован
        if(isset($_SESSION['userlogin'])) 
        {
            $cafeId=Cafe::getCafeByProductId($id);
            if(isset($_SESSION['cafeorder'])) 
            {
                if ($_SESSION['cafeorder'] != $cafeId) //если клиент заказывает с другого кафе
                {
                    echo '<script type="text/javascript">
                        alert("Заказ можно делать только в одном кафе");
                        </script>';
                    if (isset($_SESSION['products'][$id])) echo $_SESSION['products'][$id];
                    else echo 0;
                    return true;
                }
            }

            echo Cart::removeProductAjax($id);
            
            //заказ в том же кафе, товаров 0
            $productsInCart=Cart::getProducts();
            if($productsInCart==false) unset($_SESSION['cafeorder']);

            return true;
        }
        else //если клиент не авторизован
        {
            echo '<script type="text/javascript">
                alert("Перед покупкой зайдите в аккаунт");
                </script>';
            if (isset($_SESSION['products'][$id])) echo $_SESSION['products'][$id];
            else echo 0;
            return true;
        }
    }

    public function actionIndex()
    {
        date_default_timezone_set('Asia/Vladivostok');

        $cafes=array();
        $cafes=Cafe::getCafeList();

        $productsInCart=Cart::getProducts(); //товары в корзине

        if ($productsInCart)
        {
            $productsIds=array_keys($productsInCart);
            $products=Product::getProductsByIds($productsIds); //полная информация о товарах в корзине

            $totalPrice=Cart::getTotalPrice($products);
        }

        if(isset($_POST['submit'])) //оформление заказа
        {
            if(!isset($_SESSION['userlogin']))
            {
                echo '<script type="text/javascript">
                    alert("Перед покупкой зайдите в аккаунт");
                    </script>';
            }
            else
                if ($productsInCart==false)
                    echo '<script type="text/javascript">
                        alert("Ваша корзина пуста");
                        </script>';
                 else
                {
                    if($_POST['time']>=date('H:i')) 
                    {
                        $_SESSION['order_time']=$_POST['time'];
                        //this::actionOrder();

                        Cart::save($productsInCart, $totalPrice); //сохранение в БД
                        Cart::clear(); //очистка корзины

                        header("Location: /cabinet/orders");
                    }
                    else
                    {
                        echo '<script type="text/javascript">
                            alert("Укажите правильно время получения заказа");
                            </script>';
                    }
                }
        }

        require_once(ROOT.'/views/basket/basket.php');

        return true;
    }

    public function actionTotal()
    {
        $cafes=array();
        $cafes=Cafe::getCafeList();

        $productsInCart=Cart::getProducts(); //товары в корзине

        if ($productsInCart)
        {
            $productsIds=array_keys($productsInCart);
            $products=Product::getProductsByIds($productsIds); //полная информация о товарах в корзине

            $totalPrice=Cart::getTotalPrice($products);
            echo $totalPrice;
        }

        header("Location: /");

        return true;
    }

    public function actionTotalAjax()
    {
        $cafes=array();
        $cafes=Cafe::getCafeList();

        $productsInCart=Cart::getProducts(); //товары в корзине

        if ($productsInCart)
        {
            $productsIds=array_keys($productsInCart);
            $products=Product::getProductsByIds($productsIds); //полная информация о товарах в корзине

            $totalPrice=Cart::getTotalPrice($products);
            echo $totalPrice;
        }

        // $referrer=$_SERVER['HTTP_REFERER'];
        // if($referrer!='http://localhost/cart') header("Location: /");

        return true;
    }

    public function actionCansel()
    {
        Cart::clear(); //очистка корзины
        header("Location: /");
    }
}
?>