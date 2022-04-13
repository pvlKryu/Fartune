<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h1>Добрый день, <?php echo $user['login']; ?>!</h1>

        <div class="container">
            <a class="buttons-text" href="/admin/cafe">Управление кафе</a><br>
            <a class="buttons-text" href="/admin/product">Управление товарами</a><br>
            <a class="buttons-text" href="/admin/order">Управление заказами</a><br>
            <a class="buttons-text" href="/admin/user">Управление пользователями</a>
        </div>
        
</div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>