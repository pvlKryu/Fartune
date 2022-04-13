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
    </div> 

<?php include ROOT.'/views/layouts/footer.php'; ?> 