<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Редактировать данные пользователя <?php echo $user['login']; ?></h4>

        <form action="#" method="post" enctype="multipart/form-data">
            <p>ФИО:</p>
            <input type="text" name="FIO" placeholder="" value="<?php echo $FIO; ?>" required>

            <p>Номер телефона:</p>
            <input type="text" name="number" placeholder="" value="<?php echo $number; ?>" required>

            <br><br>

            <input type="submit" name="submit" value="Сохранить"/>
        </form>

        <br><br>
        <?php if(isset($errors) && is_array($errors)): ?>
            При редактировании данных возникли следующие ошибки:
            <ul>
                <?php foreach($errors as $error): ?>
                    <li> - <?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>