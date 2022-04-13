<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Редактировать кафе <?php echo $cafe['name']; ?></h4>

        <?php if(isset($errors) && is_array($errors)): ?>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li> <?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="#" method="post" enctype="multipart/form-data">
            <p>Название кафе</p>
            <input type="text" name="name" placeholder="" value="<?php echo $cafe['name']; ?>" required>

            <p>Статус</p>
            <input type="text" name="status" placeholder="" value="<?php echo $cafe['status']; ?>" required>

            <p>Местоположение</p>
            <input type="text" name="address" placeholder="" value="<?php echo $cafe['address']; ?>" required>

            <br><br>

            <p>Логотип кафе</p>
            <img src=<?php echo Cafe::getImage($id); ?> width="200" alt="" />
                                    
            <input type="file" name="image" placeholder="" value="" />

            <br><br>

            <input type="submit" name="submit" value="Сохранить"/>
        </form>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>