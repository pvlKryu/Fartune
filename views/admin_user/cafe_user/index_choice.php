<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h3>Управление работниками</h3>

        <h4>Выберите кафе</h4>

        <br>

        <div class="cafees_grids">
            <?php foreach ($cafes as $cafeDuo): ?>
                <div class="cafees_grid1" >
                <?php foreach ($cafeDuo as $cafeItem): ?>
                    <a href="/admin/user/employee/<?php echo $cafeItem['id']; ?>">
                        <img src=<?php echo Cafe::getImage($cafeItem['id']); ?> width="150" height="" alt="sandvich" class="cafees_grid_item">
                    </a>
                <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <a href="/admin/user/employee/all">
                Все работники
            <a>
        </div>    
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>