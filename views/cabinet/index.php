<?php include_once ROOT.'/views/layouts/otherheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h1>Кабинет пользователя</h1>

        <h3>Привет, <?php echo $user['login']; ?>!</h3>

        <div class="container">
            <a class="buttons-text" href="/cabinet/edit">Редактировать данные</a><br>
            <a class="buttons-text" href="/cabinet/editPassword">Сменить пароль</a><br>
            <a class="buttons-text" href="/cabinet/orders">Список заказов</a>
        </div>
        
</div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>