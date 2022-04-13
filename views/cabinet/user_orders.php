<?php include_once ROOT.'/views/layouts/otherheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h2>
            Список заказов
        </h2>
        <table class="table" border="0" width="90%" cellpadding="5">
            <tr>
                <th>Номер заказа
                    <hr align="center" width="100%" size="6" color="#FFF850" />
                </th>
                <th>Статус
                    <hr align="center" width="100%" size="6" color="#FFF850" />
                </th>
                <th>Дата и время получения
                    <hr align="center" width="100%" size="6" color="#FFF850" />
                </th>
                <th>Кафе
                    <hr align="center" width="100%" size="6" color="#FFF850" />
                </th>
                <th>Сумма
                    <hr align="center" width="100%" size="6" color="#FFF850" />
                </th>
            </tr>  
            <?php foreach($orders as $order): ?>
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
                    <td>
                        <?php echo $order['id']; ?>
                    </td>
                    <td>
                        <?php echo $order['status']; ?>
                    </td>
                    <td>
                        <?php echo date("d.m.Y",strtotime($order['date'])); ?>
                        <?php echo date("H:i",strtotime($order['time'])); ?>
                    </td>
                    <td>
                        <?php 
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
                    <td>
                        <?php echo $order['amount']; ?>р
                    </td>
                    <td>
                        <script>
                        function ShowDiv(order_id){
                            var showme=document.getElementById('showDiv'+order_id);
                            if (showme.style.display !== 'none') showme.style.display = 'none';
                            else showme.style.display = 'block';
                        };
                        </script>

                        <input type="button" onclick="ShowDiv(<?php echo $order['id']; ?>)" value="+" id="" />
                    </td>
                </tr>
                <tr> <td>
                    <div id="showDiv<?php echo $order['id']; ?>" style="display: none;">
                        <?php $order_content=json_decode($order['content'], true); ?>
                        <?php 
                        $productsIds=array_keys($order_content);
                        $products=Product::getProductsByIds($productsIds); //полная информация о товарах в заказе
                        $deletedProducts=Product::getDeletedProductsByIds($productsIds);
                        ?>
                        <table class="table" <?php echo $fontColor;?> >
                        <?php foreach($products as $product): ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $order_content[$product['id']]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach($deletedProducts as $product): ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $order_content[$product['id']]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </table>
                    </div>
                </td> </tr>
            <?php endforeach; ?>
        </table>

            <!-- 
            $orders[$i][$j]['content']=$row['order_content']; -->
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>