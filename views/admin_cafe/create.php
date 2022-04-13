<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Добавить новое кафе</h4>

        <?php if(isset($errors) && is_array($errors)): ?>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li> <?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="#" method="post" enctype="multipart/form-data">
            <p>Название кафе</p>
            <input type="text" name="name" placeholder="" value="" required>

            <p>Статус</p>
            <input type="text" name="status" placeholder="" value="" required>

            <p>Местоположение</p>
            <input type="text" name="address" placeholder="" value="" required>

            <br><br>

            <p>Логотип кафе</p>
            <input type="file" name="image" placeholder="" value="" required>

            <br><br>

            <input type="submit" name="submit" value="Сохранить"/>
        </form>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>