<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h3>Управление товарами</h3>

        <h4>Список всех товаров</h4>

        <br>

        <table>
            <tr>
                <th>ID товара</th>
                <th>Кафе</th>
                <th>Название товара</th>
                <th>Цена</th>
                <th>Описание</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($productList as $item): ?>
            <?php foreach ($item as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['cafe']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><a href="/admin/product/update/<?php echo $product['id']; ?>">Редактировать</a></td>
                <td><a href="/admin/product/delete/<?php echo $product['id']; ?>">Удалить</a></td>
            </tr>
            <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>