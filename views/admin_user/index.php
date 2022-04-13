<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h3>Управление пользователями</h3>

        <h4>Выберите тип пользователей</h4>

        <br>

        <div class="container">
            <a class="buttons-text" href="/admin/user/customer">Клиенты</a><br>
            <a class="buttons-text" href="/admin/user/employee">Работники</a><br>
        </div>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>