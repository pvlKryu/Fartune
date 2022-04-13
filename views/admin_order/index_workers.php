<!DOCTYPE html> 
<html>  

<head> 
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <title>Заказы</title>
    <link rel="shortcut icon" href="/template/images/web_logo.png" type="image/png">
    <link rel="stylesheet" href="/template/css/product_order.css">
</head>

<body>   
    <div class="header_container" >
        <header class="header"> 
            <div class="logo">
                <img src="/template/images/logo.jpg" width="142" height="" alt="logo" class="cofee_logo">
            </div> 
      
            <button class="out_btn">
            <p>
            <?php //Выйти/войти
                //if ($_SESSION['LoginBool_kafe']==1) echo '<a class="buttons-text" width=297 href="logout.php">Выйти</a>';
                //else echo '<a class="buttons-text" width=297 href="/views/user/login.html">Войти</a>';
                echo "Выйти.";
            ?>
            </p>
             </button>
        </header>
    </div>

    <div class="basket">
        <table class="table" border="0" width="90%" cellpadding="5">
            
            <div class="table_title">
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
                    <th>Клиент
                       <hr align="center" width="100%" size="6" color="#FFF850" />
                    </th>
                    <th>Сумма
                         <hr align="center" width="100%" size="6" color="#FFF850" />
                    </th>
                    <th>Открыть
                       <hr align="center" width="100%" size="6" color="#FFF850" />
                    </th>
                </tr>  
            </div>

            <?php foreach ($orders as $order): ?>
                <?php 
                    $nowTime=date("H:i");
                    $nowDay=date("Y-m-d");
                    if ($order['status']=="отказ") $fontColor ='style="color: grey;"';
                    else 
                        if (($order['status']!="выдано") && (($order['date']<$nowDay) || (($order['date']==$nowDay) && (($order['time']<$nowTime)))))
                            $fontColor ='style="color: red;"';
                        else $fontColor ='';
                ?>
                <div class="table_element">
                    <tr <?php echo $fontColor;?> >
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <td><?php echo date("d.m.Y",strtotime($order['date'])); ?>
                            <?php echo date("H:i",strtotime($order['time'])); ?>
                        </td>
                        <td><?php echo $order['user'];?></td>
                        <td><?php echo $order['amount']; ?>р</td>
                        <td>
                            <button class="button__delete">  
                                <a style="outline: none; text-decoration: none; color: #333333;" href="/admin/order/view/<?php echo $order['id']; ?>">+</a>
                            </button>    
                        </td>
                    </tr>
                    <tr><th><br></th></tr>
                </div>
            <?php endforeach; ?>   
        </table>
            

        <div class="basket_title">
        </div>
        <div class="basket_position">
        </div>

    </div>
    <div class="bckg_pict">
        <img src="/template/images/Ramki.png" width="500" height="" alt="logo" class="cofee_logo">
    </div>

</body>
</html>