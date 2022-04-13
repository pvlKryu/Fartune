<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Добавить нового работника</h4>

        <p>Кафе - <?php echo $cafe['name']; ?></p>

        <form action="#" method="post" enctype="multipart/form-data">
            <p>Логин</p>
            <input type="text" name="login" placeholder="" value="" required>

            <p>Роль</p>
            <select name="role">
                    <?php if(is_array($roleList)): ?>
                        <?php foreach($roleList as $role): ?>
                            <option value="<?php echo $role; ?>">
                                <?php echo $role; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </select>

            <p>Пароль</p>
            <input type="password" name="password" placeholder="" value="<?php echo $options['password']; ?>" required>

            <br><br>

            <input type="submit" name="submit" value="Сохранить"/>
        </form>

        <br><br>
        <?php if(isset($errors) && is_array($errors)): ?>
            При создании нового работника возникли следующие ошибки:
            <ul>
                <?php foreach($errors as $error): ?>
                    <li> - <?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>