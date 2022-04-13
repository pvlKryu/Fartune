    <footer class="down_footer">
        <div class="down_footer_text">
            <i class="fas fa-h2    ">
                Тех.поддержка: +7 (914) 664-96-76 <br> 
            </i>

            <i class="fas fa-h2    ">
                По вопросам сотрудничества: mkhrmva@gmail.com  
            </i>   
        </div>
        <div class="logo">
            <a href="/"><img src="\template\images\logo.jpg" width="302" height="" alt="logo" class="down_footer_logo"></a>
        </div> 
    </footer class="down_footer">

    <!-- Скрипты для добавления товаров в корзину (Ajax) -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
        $(document).ready(function()
        {
            $(".add-to-cart").click(function()
            {
                var id=$(this).attr("data-id");
                $.post("/cart/addAjax/"+id, {}, function(data)
                {
                    $("#product-count"+id).html(data);
                });
                return false;
            });
        });
    </script>
    <script>
        $(document).ready(function()
        {
            $(".remove-from-cart").click(function()
            {
                var id=$(this).attr("data-id");
                $.post("/cart/removeAjax/"+id, {}, function(data)
                {
                    $("#product-count"+id).html(data);
                });
                return false;
            });
        });
    </script>

</body>   
</html>