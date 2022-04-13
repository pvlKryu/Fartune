<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Сменить пароль работника <?php echo $cafeUser['login']; ?></h4>

        <form action="#" method="post" enctype="multipart/form-data">
            <p>Новый пароль:</p>
            <input type="password" name="newPassword" placeholder="" value="<?php echo $newPassword; ?>" required>

            <br><br>

            <input type="submit" name="submit" value="Сохранить"/>
        </form>

        <br><br>
        <?php if(isset($errors) && is_array($errors)): ?>
            При смене пароля возникли следующие ошибки:
            <ul>
                <?php foreach($errors as $error): ?>
                    <li> - <?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>