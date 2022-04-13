<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Добавить нового пользователя</h4>

        <form action="#" method="post" enctype="multipart/form-data">                         
            <p>ФИО</p>
            <input type="text" name="FIO" placeholder="" value="<?php echo $options['FIO']; ?>" required>

            <p>Номер телефона</p>
            <input type="text" name="number" placeholder="" value="<?php echo $options['number']; ?>" required>

            <p>Логин</p>
            <input type="text" name="login" placeholder="" value="<?php echo $options['login']; ?>" required>

            <p>Пароль</p>
            <input type="password" name="password" placeholder="" value="<?php echo $options['password']; ?>" required>

            <br><br>

            <input type="submit" name="submit" value="Сохранить"/>
        </form>

        <br><br>
        <?php if(isset($errors) && is_array($errors)): ?>
            При создании нового пользователя возникли следующие ошибки:
            <ul>
                <?php foreach($errors as $error): ?>
                    <li> - <?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>