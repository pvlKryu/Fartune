<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h3>Управление пользователями</h3>

        <a href="/admin/user/customer/create">Добавить пользователя</a>

        <h4>Список пользователей</h4>

        <br>

        <table>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>ФИО</th>
                <th>Номер</th>
                <th>Статус</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['login']; ?></td>
                <td><?php echo $user['FIO']; ?></td>
                <td><?php echo $user['number']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td><a href="/admin/user/customer/update/<?php echo $user['id']; ?>">Редактировать</a></td>
                <td><a href="/admin/user/customer/password/<?php echo $user['id']; ?>">Сменить пароль</a></td>
                <td><a href="/admin/user/customer/orders/<?php echo $user['id']; ?>">Заказы</a></td>
                <td><a href="/admin/user/customer/delete/<?php echo $user['id']; ?>">Удалить</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>