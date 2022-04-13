<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h3>Управление работниками</h3>

        <a href="/admin/user/employee/create/<?php echo $cafe_id; ?>">Добавить работника</a>

        <h4>Список работников кафе <?php echo $cafe['name'] ?></h4>

        <br>

        <table>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Роль</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($cafeUserList as $cafeUser): ?>
            <tr>
                <td><?php echo $cafeUser['id']; ?></td>
                <td><?php echo $cafeUser['login']; ?></td>
                <td><?php echo $cafeUser['role']; ?></td>
                <td><a href="/admin/user/employee/update/<?php echo $cafeUser['id']; ?>">Редактировать</a></td>
                <td><a href="/admin/user/employee/password/<?php echo $cafeUser['id']; ?>">Сменить пароль</a></td>
                <td><a href="/admin/user/employee/delete/<?php echo $cafeUser['id']; ?>">Удалить</a></td>
            </tr>
            <?php endforeach; ?>
        </table>

        
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>