<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Редактировать данные работника <?php echo $cafeUser['login']; ?></h4>

        <p>Кафе - <?php echo $cafe['name']; ?></p>

        <form action="#" method="post" enctype="multipart/form-data">
            <p>Роль</p>
            <select name="role">
                    <?php if(is_array($roleList)): ?>
                        <?php foreach($roleList as $role): ?>
                            <option value="<?php echo $role; ?>" <?php if ($cafeUser['role']==$role) echo "selected";?> >
                                <?php echo $role; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </select>

            <br><br>

            <input type="submit" name="submit" value="Сохранить"/>
        </form>

        <br><br>
        <?php if(isset($errors) && is_array($errors)): ?>
            При редактировании данных работника возникли следующие ошибки:
            <ul>
                <?php foreach($errors as $error): ?>
                    <li> - <?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>