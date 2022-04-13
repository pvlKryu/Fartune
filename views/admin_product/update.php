<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Редактировать товар #<?php echo $id; ?></h4>

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
            <input type="text" name="name" placeholder="" value="<?php echo $product['name']; ?>" required>

            <p>Цена</p>
            <input type="text" name="price" placeholder="" value="<?php echo $product['price']; ?>" required>

            <p>Описание</p>
            <input type="text" name="description" placeholder="" value="<?php echo $product['description']; ?>" required>

            <!-- <p>Кафе</p>
            <select name="cafe_id">
                    <?php if(is_array($cafeList)): ?>
                        <?php foreach($cafeList as $cafe): ?>
                            <option value="<?php echo $cafe['id']; ?>"
                                <?php if ($product['cafe_id']==$cafe['id']) echo 'selected="selected"'; ?>>
                                <?php echo $cafe['login']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </select> -->

            <br><br>

            <p>Изображение товара</p>
            <img src=<?php echo Product::getImage($product['id']); ?> width="200" alt="" />
                                    
            <input type="file" name="image" placeholder="" value="" />

            <br><br>

            <input type="submit" name="submit" value="Сохранить"/>
        </form>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>