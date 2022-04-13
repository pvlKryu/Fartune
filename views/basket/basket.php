<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/template/css/basket.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/template/images/web_logo.png" type="image/png">
  <title>Faturne - Корзина</title>
</head>
<body>
  <div class="shopping-cart">
    <!-- Title -->
    <div class="title">
      Корзина
      <a href="/" class="title__exit">
        <img src="/template/images/exit.svg" width="35px"class="title__exit-btn">
      </a>
    </div>

    <div class="item">
      <div class="buttons">
        <!-- <span class="delete-btn" width="15px"></span> -->
      </div>

      <div class="description">
        <span style="font-size:20px;">Кафе</span>
      </div>
   
      <div class="description">
        <span style="font-size:20px;">Товар</span>
      </div>
   
      <div class="description">
        <span style="font-size:20px;">Количество</span>
      </div>
   
      <div class="description">
        <span style="font-size:20px;">Стоимость</span>
      </div>
    </div>
        
    <?php 
      if(!isset($_SESSION['userlogin'])) echo '<div class="item"><span style="font-size:18px;">Перед покупкой зайдите в аккаунт</span></div>'; 
      else if ($productsInCart==false) 
        echo '<div class="item"><div class="description"><span style="font-size:18px;">Ваша корзина пуста</span></div></div>';
        else
        {
          foreach ($products as $product): ?>
              <div class="item">
                <div class="buttons">
                <!-- <span class="delete-btn" width="15px"></span> -->
                </div>
   
                <div class="description">
                  <span style="font-size:20px;"><?php echo $product['cafe_name']; ?></span>
                </div>

                <div class="description">
                  <span style="font-size:20px;"><?php echo $product['name'] ?></span>
                </div>
   
                <!-- <div class="description">
                  <span style="font-size:20px;"><?php echo $productsInCart[$product['id']] ?></span>
                </div> -->

                <div class="description">
                  <button class="card_button1" type="button">
                    <p><a class="card_buttons_text1 remove-from-cart" data-id="<?php echo $product['id']; ?>" href="#">-</a></p>
                  </button>
                    <span id="product-count<?php echo $product['id']; ?>" style="font-size:20px;">
                    <?php
                      if(isset($_SESSION['products'][$product['id']])) echo $_SESSION['products'][$product['id']];
                      else echo 0;
                    ?>
                    </span>
                  <button  class="card_button1" type="button">
                    <p><a class="card_buttons_text1 add-to-cart" data-id="<?php echo $product['id']; ?>" href="#">+</a></p>
                  </button>
                </div>
   
                <div class="description">
                  <span style="font-size:20px;"> <?php echo $product['price']; ?>p</span>
                </div>

              </div>
          <?php endforeach;
        }
    ?>

    <form method="POST" >
      <div class="item">
        <a class="text"> Время получения заказа:</a>
        
        <?php $mintime=date("H:i",strtotime('+05 minutes', strtotime(date("H:i"))));?>
        <input type="time" class="time__set-buy_field_2" name="time" min="<?php echo $mintime;?>" value="<?php echo $mintime;?>">
        
        <!-- <input type="text" class="time__set-buy_field" name="hour">
        <img src="/template/images/dots.svg" class="time__set-buy_field" width="20px" />
        <input type="text" class="time__set-buy_field" name="minute"> -->
      </div>

      <div class="outro">
        <a class="price"><span id="total-price">
          <?php if(isset($_SESSION['userlogin']) and isset($totalPrice)) echo $totalPrice; else echo '0'; ?></span>p
        </a>
        

        <button type="submit" class= "button__conf" width="100px" name="submit"> 
          Оформить заказ
        </button> 
        
        <button type="submit" class= "button__cancel" width="100px"  class="title__exit" name="cancel">  
          <p><a style="outline: none; text-decoration: none; color: #333333;" width=297  href="/cart/cansel">Отменить заказ</a></p>
        </button>
      </div>
    </form> 
  </div>
</div>

<!-- Скрипты для добавления товаров в корзину (Ajax) -->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
        $(document).ready(function()
        {
            $(".add-to-cart").click(function()
            {
                var id=$(this).attr("data-id");
                $.post("/cart/addAjax/"+id, {}, function(data)
                {
                    $("#product-count"+id).html(data);
                });
                $.post("/cart/totalSum", {}, function(data)
                {
                  $("#total-price").html(data);
                });
                return false;
            });
        });
    </script>
    <script>
        $(document).ready(function()
        {
            $(".remove-from-cart").click(function()
            {
                var id=$(this).attr("data-id");
                $.post("/cart/removeAjax/"+id, {}, function(data)
                {
                    $("#product-count"+id).html(data);
                });
                $.post("/cart/totalSum", {}, function(data)
                {
                  $("#total-price").html(data);
                });
                return false;
            });
        });
    </script>

</body>
</html>