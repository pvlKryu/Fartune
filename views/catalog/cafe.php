<?php include ROOT.'/views/layouts/indexheader.php'; ?>

    <div class="main_container" >
        <div class="info" >
            <div class="sandvich_pict" >
                <img src="\template\images\сэндвич.jpg" width="503" height="" alt="sandvich" class="sandvich">
            </div>
            <p><a name="info"></a></p>   
            <div class="yellow_box" >
                <div class="yellow_box_main_text" >
                    <h2>Кто мы и зачем</h2>
                    <p2>Мы - сервис для заказа еды в кафетериях ДВФУ. Заказывай еду заранее, успевай всё, будь сыт и счастлив! =) </p2>
                </div>
                
                <div class="quote" >
                    <p2>Если хочешь продлить свою жизнь, укороти свои трапезы.</p2>
                    <p2> </p2>
                    <p2>©Бенджамин Франклин </p2>
                </div>
            </div>  
        </div>

        <div class="cafees" >
            <div class="cafees_text" >
                <h2>Кафетерии, работающие с нами</h2>
                <p2>Посмотрите меню того места, в котором хочется перекусить сегодня!</p2>
            </div>

            <div class="cafees_grids">
            <?php foreach ($cafes as $cafeDuo): ?>
                <div class="cafees_grid1" >
                <?php foreach ($cafeDuo as $cafeItem): ?>
                    <a href="/cafe/<?php echo $cafeItem['id']; ?>#catalog">    
                        <img src=<?php echo Cafe::getImage($cafeItem['id']); ?> width="150" height="" alt="sandvich" class="cafees_grid_item">
                    </a>
                <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            </div>
            <p><a name="catalog"></a></p>   
        </div>

        <div class="catalog" >
            <div class="catalog_title">
                <!-- <h2>Меню </h2> -->
                <p2><b>Меню </b></p2> <br>
                <p2><?php echo $cafe['name']; ?></p2>
                <img src="\template\images\Vector.svg" width="19" height="" alt="star">
                <p2 class="yellow_rating"><?php echo $cafe['status']; ?></p2>
                <p2> <font size="4"><?php echo $cafe['address']; ?></font></p2>
            </div>
        </div>

        <form class="log-form" method="POST">
            <div class="slider">
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php $qslide=0; ?>
                        <?php foreach ($cafeProducts as $Products): 
                            if ($qslide==0) echo '
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="'.$qslide.'" class="active" aria-current="true" aria-label="Slide '.($qslide+1).'"></button>
                            ';
                            else echo '
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="'.$qslide.'" aria-label="Slide '.($qslide+1).'"></button>
                            ';
                            $qslide++;
                        endforeach; ?>
                    </div>

                    <div class="carousel-inner">
                        <?php $qslide=0; ?>
                        <?php foreach ($cafeProducts as $Products): 
                            if ($qslide==0) echo '<div class="carousel-item active">';
                            else echo '<div class="carousel-item">';
                            $qslide++;
                        ?>
                            
                            <!-- <div class="carousel_title">
                                Еда
                            </div> -->

                            <div class="cards1">
                                <?php foreach ($Products as $product): ?>
                                <div class="card1 w-50">
                                    <!-- <img src=<?php echo $product['img']; ?> alt="image1" class="card-image"> -->
                                    <img src=<?php echo Product::getImage($product['id']); ?> alt="image1" class="card-image">
                                    <div class="card-text">
                                        <div class="card-heading">
                                            <h3 class="card-title">
                                                <?php echo $product['name']; ?>
                                            </h3>
                                        </div>
                                        <div class="card-info">
                                            <div class="price">
                                            <?php echo $product['price']; ?>₽
                                            </div>
                                            <div class="category">
                                            <?php echo $product['description']; ?>
                                            </div>
                                        </div>
                    
                                        <!-- <div class="card_buttons1">
                                            <button class="card_button1" type="button">
                                                <p><a class="card_buttons_text1" href="/index.php/cart/remove/<?php echo $product['id']; ?>">-</a></p>
                                            </button>
                                            <?php
                                                if(isset($_SESSION['products'][$product['id']])) echo $_SESSION['products'][$product['id']];
                                                else echo 0;
                                            ?>
                                            <button  class="card_button1" type="button">
                                                <p><a class="card_buttons_text1" href="/index.php/cart/add/<?php echo $product['id']; ?>">+</a></p>
                                            </button>
                                        </div> -->

                                        <div class="card_buttons1">
                                            <button class="card_button1" type="button">
                                                <p><a class="card_buttons_text1 remove-from-cart" data-id="<?php echo $product['id']; ?>" href="#">-</a></p>
                                            </button>
                                            <span id="product-count<?php echo $product['id']; ?>">
                                            <?php
                                                if(isset($_SESSION['products'][$product['id']])) echo $_SESSION['products'][$product['id']];
                                                else echo 0;
                                            ?>
                                            </span>
                                            <button  class="card_button1" type="button">
                                                <p><a class="card_buttons_text1 btn-default add-to-cart" data-id="<?php echo $product['id']; ?>" href="#">+</a></p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?> 
                                <!-- товары конец -->
                            </div>
                        </div> 
                        <?php endforeach; ?>
                        <!-- слайды конец -->
                    </div>

                    <div class="slider_btns">
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <button class="yellow_button_2">
            <p><a class="buttons-text" width=297  href="/cart">Корзина</a></p>
            <img src="/template/images/basket.png" class="basket-pict" alt="basket1" >
        </button>

    </div> 

<?php include ROOT.'/views/layouts/footer.php'; ?>  