<?php include_once ROOT.'/views/layouts/adminheader.php'; ?>

<section>
    <div class="container" style="font-family: Montserrat;">
        <br>    
        <h4>Удалить работника <?php echo $cafeUser['login']; ?>!</h4>

        <p>Вы действительно хотите удалить этого работника?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить"/>
        </form>
        
    </div>
</section>

<?php include_once ROOT.'/views/layouts/footer.php'; ?>