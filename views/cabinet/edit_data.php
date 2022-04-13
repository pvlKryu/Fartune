<?php include_once ROOT.'/views/layouts/otherheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h2>
            Редактирование данных
        </h2>
            <form class="reg-form" method="POST">
                <fieldset class=reg-form__wrap>
                    <ul class="reg-form__info">
                       <li>
                            <label for="n">ФИО:</label> <input name="FIO" type="text" class="reg-form__field" value="<?php echo $FIO; ?>" required>
                        </li>
                        <li>
                            <label for="ln">Номер телефона:</label> <input name="number" type="text" class="reg-form__field" value="<?php echo $number; ?>" required>
                        </li>
                        <li>     
                           <input name="submit" type="submit" class="reg-form__submit" value="Сохранить">
                        </li>
                    </ul>
                </fieldset>
            </form>

                <?php if ($result): ?>
                    <p>Данные отредактированы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <b>При редактировании данных произошли следующие ошибки:</b><br>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?> </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif ?>
                <?php endif; ?>
        
</div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>