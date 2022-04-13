<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Редактировать заказ #<?php echo $order['id']; ?></h4>

        <?php if(isset($errors) && is_array($errors)): ?>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li> <?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div>
            <p>Дата и время получения - 
                <?php echo date("d.m.Y",strtotime($order['date'])); ?>
                <?php echo date("H:i",strtotime($order['time'])); ?>
            </p>
            <p>Кафе - 
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
            </p>
            <p>Сумма - <?php echo $order['amount']; ?>р</p>

            
            <?php $order_content=json_decode($order['content'], true); ?>
                <?php 
                    $productsIds=array_keys($order_content);
                    $products=Product::getProductsByIds($productsIds); //полная информация о товарах в заказе
                    $deletedProducts=Product::getDeletedProductsByIds($productsIds);
                    if ($products==null&&$deletedProducts==null) echo "<b>Товары удалены с сайта</b>";
                ?>
                <table class="table">
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

            <form action="#" method="post" enctype="multipart/form-data">
            
                <p>Статус заказа</p>
                <select name="status">
                    <?php if(is_array($statusList)): ?>
                        <?php foreach($statusList as $status): ?>
                            <option value="<?php echo $status['name']; ?>"
                                <?php if ($order['status']==$status['name']) echo 'selected="selected"'; ?>>
                                <?php echo $status['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <br><br>

                <input type="submit" name="submit" value="Сохранить"/>
            </form>

        </div>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>