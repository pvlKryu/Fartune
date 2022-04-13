<?php include_once ROOT.'/views/layouts/otherheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h2>
            Смена пароля
        </h2>
            <form class="reg-form" method="POST">
                <fieldset class=reg-form__wrap>
                    <ul class="reg-form__info">
                        <li>     
                            <label for="an">Старый пароль:</label> <input name="checkPassword" type="password" class="reg-form__field" value="<?php echo $checkPassword; ?>" required>
                        </li>
                        <li>     
                            <label for="an">Новый пароль:</label> <input name="newPassword" type="password" class="reg-form__field" value="<?php echo $newPassword; ?>" required>
                        </li>
                        <li>     
                           <input name="submit" type="submit" class="reg-form__submit" value="Сохранить">
                        </li>
                    </ul>
                </fieldset>
            </form>

                <?php if ($result): ?>
                    <p>Пароль изменен!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <b>При смене пароля произошли следующие ошибки:</b><br>
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