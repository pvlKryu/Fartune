<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Добавить новый товар</h4>

        <?php if(isset($errors) && is_array($errors)): ?>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li> <?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <p>Кафе - <?php echo $cafe['name']; ?></p>

        <form action="#" method="post" enctype="multipart/form-data">
            <p>Название товара</p>
            <input type="text" name="name" placeholder="" value="" required>

            <p>Цена</p>
            <input type="text" name="price" placeholder="" value="" required>

            <p>Описание</p>
            <input type="text" name="description" placeholder="" value="" required>

            <!-- <p>Кафе</p>
            <select name="cafe_id">
                    <?php if(is_array($cafeList)): ?>
                        <?php foreach($cafeList as $cafe): ?>
                            <option value="<?php echo $cafe['id']; ?>">
                                <?php echo $cafe['login']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </select> -->

            <br><br>

            <p>Изображение товара</p>
            <input type="file" name="image" placeholder="" value="" required>

            <br><br>

            <input type="submit" name="submit" value="Сохранить"/>
        </form>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>