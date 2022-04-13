<?php
class AdminOrderController extends AdminBase
{
    public function actionIndexAll()
    {
        self::checkAdmin(); //Проверка доступа

        $orders=Order::getOrders();

        require_once(ROOT.'/views/admin_order/indexAll.php');
        return true;
    }

    public function actionView($id)
    {
        self::checkAdmin(); //Проверка доступа

        $order=Order::getOrderById($id);

        $cafe_id=$order['cafe'];

        $statusList=Order::getStatusList();

        if (isset($_POST['submit']))
        {
            $options['status']=$_POST['status'];

            Order::updateOrderStatusById($id,$options['status']);

            header("Location: /admin/order/{$cafe_id}");
        }

        require_once(ROOT.'/views/admin_order/view.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin(); //Проверка доступа
        $order=Order::getOrderById($id);

        if(isset($_POST['submit']))
        {   
            Order::deleteOrderById($id);

            header("Location: /admin/order");
        }

        require_once(ROOT.'/views/admin_order/delete.php');
        return true;
    } 

    public function actionIndex($cafe_id)
    {
        self::checkAdmin(); //Проверка доступа

        $cafe=Cafe::getCafeById($cafe_id);

        $orders=Order::getOrdersListByCafe($cafe_id);

        require_once(ROOT.'/views/admin_order/index.php');
        return true;
    }  

    public function actionIndexChoice()
    {
        self::checkAdmin(); //Проверка доступа

        $cafes=array();
        $cafes=Cafe::getCafeList();

        require_once(ROOT.'/views/admin_order/index_choice.php');
        return true;
    } 

}
?>