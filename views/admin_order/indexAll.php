<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h3>Управление заказами</h3>

        <h4>Список заказов</h4>

        <br>

        <table>
            <tr>
                <th>Номер заказа</th>
                <th>Статус</th>
                <th>Дата и время получения</th>
                <th>Кафе</th>
                <th>Клиент</th>
                <th>Сумма</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($orders as $order): ?>
                <?php 
                    $nowTime=date("H:i");
                    $nowDay=date("Y-m-d");
                    if ($order['status']=="отказ") $fontColor ='style="color: red;"';
                    else 
                        if ($order['status']=="выдано") $fontColor ='style="color: green;"';
                        else
                            if (($order['date']<$nowDay) || (($order['date']==$nowDay) && (($order['time']<$nowTime))))
                                $fontColor ='style="color: grey;"';
                            else $fontColor ='';
                ?>
            <tr <?php echo $fontColor;?> >
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['status']; ?></td>
                <td><?php echo date("d.m.Y",strtotime($order['date'])); ?>
                    <?php echo date("H:i",strtotime($order['time'])); ?>
                </td>
                <td><?php 
                    $cafe=Cafe::getCafeById(intval($order['cafe']));
                    if($cafe) echo $cafe['name']; 
                    else 
                    {
                        $cafe=Cafe::getDeletedCafeById(intval($order['cafe']));
                        if($cafe) echo $cafe['name']; 
                        else echo "удалено";
                    }
                    ?>
                </td>
                <td><?php echo $order['user'];?></td>
                <td><?php echo $order['amount']; ?>р</td>
                <td><a href="/admin/order/view/<?php echo $order['id']; ?>">Открыть</a></td>
                <td><a href="/admin/order/delete/<?php echo $order['id']; ?>">Удалить</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>