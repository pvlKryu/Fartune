<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Удалить товар #<?php echo $id; ?>!</h4>

        <p>Вы действительно хотите удалить этот товар?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить"/>
        </form>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>