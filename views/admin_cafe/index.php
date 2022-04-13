<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h3>Управление кафе</h3>

        <a href="/admin/cafe/create">Добавить кафе</a>

        <h4>Список кафе</h4>

        <br>

        <table>
            <tr>
                <th>ID кафе</th>
                <th>Название кафе</th>
                <th>Статус</th>
                <th>Местоположение</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($cafes as $cafeDuo): ?>
            <?php foreach ($cafeDuo as $cafe): ?>
            <tr>
                <td><?php echo $cafe['id']; ?></td>
                <td><?php echo $cafe['login']; ?></td>
                <td><?php echo $cafe['status']; ?></td>
                <td><?php echo $cafe['address']; ?></td>
                <td><a href="/admin/product/<?php echo $cafe['id']; ?>">Товары</a></td>
                <td><a href="/admin/order/<?php echo $cafe['id']; ?>">Заказы</a></td>
                <td><a href="/admin/user/employee/<?php echo $cafe['id']; ?>">Работники</a></td>
                <td><a href="/admin/cafe/update/<?php echo $cafe['id']; ?>">Редактировать</a></td>
                <td><a href="/admin/cafe/delete/<?php echo $cafe['id']; ?>">Удалить</a></td>
            </tr>
            <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>