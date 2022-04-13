<?php
class Order
{
    public static function getOrders()
    {
        $orders=array();

        $db=Db::getConnection();

        $result = $db->query("SELECT id, amount, time, date, cafe, status, content, user FROM product_order");

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
            $orders[$i]['user']=$row['user'];
            $i++;
        }

        return $orders;
    }

    public static function getOrderById($id)
    {
        $order=array();

        $db=Db::getConnection();

        $sql='SELECT * FROM product_order WHERE id = :id';

        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC); //результат в виде массива
        $result->execute();

        return $result->fetch();
    }

    public static function getStatusList()
    {
        $status=array();

        $status[0]['name']="отправлено";
        $status[1]['name']="принято";
        $status[2]['name']="готово";
        $status[3]['name']="выдано";
        $status[4]['name']="отказ";

        return $status;
    }

    public static function updateOrderStatusById($id,$status)
    {
        $db=Db::getConnection();

        $sql = "UPDATE product_order SET status=:status WHERE id=:id";

        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function deleteOrderById($id)
    {
        $db=Db::getConnection();

        $sql = "DELETE FROM product_order WHERE id = :id";

        $result=$db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getOrdersListByCafe($cafeId = false)
    {
        if ($cafeId)
        {
            $orders=array();

            $db=Db::getConnection();

            $result = $db->query("SELECT id, amount, time, date, cafe, status, content, user FROM product_order WHERE cafe='$cafeId'");

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
                $orders[$i]['user']=$row['user'];
                $i++;
            }

            return $orders;
        }
    }

    public static function getOrdersListByCafeSortByTime($cafeId = false)
    {
        if ($cafeId)
        {
            $orders=array();

            $db=Db::getConnection();

            $result = $db->query("SELECT id, amount, time, date, cafe, status, content, user FROM product_order WHERE cafe='$cafeId' ORDER BY date, time");

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
                $orders[$i]['user']=$row['user'];
                $i++;
            }

            return $orders;
        }
    }
}
?>