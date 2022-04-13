<?php
class AdminProductController extends AdminBase
{
    public function actionIndex($cafe_id)
    {
        self::checkAdmin(); //Проверка доступа

        $cafe=Cafe::getCafeById($cafe_id);

        $productList=Product::getProductsListByCafe($cafe_id);

        require_once(ROOT.'/views/admin_product/index.php');
        return true;
    }  

    public function actionCreate($cafe_id)
    {
        self::checkAdmin(); //Проверка доступа

        $cafe=Cafe::getCafeById($cafe_id);

        if (isset($_POST['submit']))
        {
            $options['name']=$_POST['name'];
            // $options['cafe_id']=$_POST['cafe_id'];
            $options['cafe_id']=$cafe_id;
            $options['price']=$_POST['price'];
            $options['description']=$_POST['description'];

            $errors=false;

            // if(!isset($options['name']) || empty($options['name'])) $errors[]='Заполните поля';

            if($errors==false)
            {
                $id=Product::createProduct($options);

                if ($id)
                {
                    if (is_uploaded_file($_FILES["image"]["tmp_name"]))
                    {
                        //загрузка нового файла
                        $fileName=$_FILES["image"]["name"];
                        $fileNameCmps=explode(".", $fileName);
                        $type=strtolower(end($fileNameCmps));

                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/upload/images/products/{$id}.{$type}");
                        //echo $_SERVER['DOCUMENT_ROOT']."/upload/images/products/{$id}.{$type}";
                    }
                }
            }

            header("Location: /admin/product/{$cafe_id}");
        }

        require_once(ROOT.'/views/admin_product/create.php');
        return true;
    }  

    public function actionUpdate($id)
    {
        self::checkAdmin(); //Проверка доступа

        $product=Product::getProductById($id);
        $cafe_id=$product['cafe_id'];

        $cafe=Cafe::getCafeById($cafe_id);

        if (isset($_POST['submit']))
        {
            $options['name']=$_POST['name'];
            // $options['cafe_id']=$_POST['cafe_id'];
            $options['cafe_id']=$cafe_id;
            $options['price']=$_POST['price'];
            $options['description']=$_POST['description'];

            if(Product::updateProductById($id,$options))
            {
                if (is_uploaded_file($_FILES["image"]["tmp_name"]))
                {
                    //удаление существующего файла
                    $existimage=Product::getImage($id);
                    if ($existimage!='/upload/images/products/no-image.jpg')
                        unlink($_SERVER['DOCUMENT_ROOT']."{$existimage}");

                    //загрузка нового файла
                    $fileName=$_FILES["image"]["name"];
                    $fileNameCmps=explode(".", $fileName);
                    $type=strtolower(end($fileNameCmps));

                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/upload/images/products/{$id}.{$type}");
                    //echo $_SERVER['DOCUMENT_ROOT']."/upload/images/products/{$id}.{$type}";
                }
            }

            header("Location: /admin/product/{$cafe_id}");
        }

        require_once(ROOT.'/views/admin_product/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin(); //Проверка доступа

        $product=Product::getProductById($id);
        $cafe_id=$product['cafe_id'];

        if(isset($_POST['submit']))
        {   
            Product::deleteProductById($id);

            header("Location: /admin/product/{$cafe_id}");
        }

        require_once(ROOT.'/views/admin_product/delete.php');
        return true;
    } 

    public function actionIndexChoice()
    {
        self::checkAdmin(); //Проверка доступа

        $cafes=array();
        $cafes=Cafe::getCafeList();

        require_once(ROOT.'/views/admin_product/index_choice.php');
        return true;
    }  

    public function actionIndexAll()
    {
        self::checkAdmin(); //Проверка доступа

        $productList=Product::getAllProducts();

        require_once(ROOT.'/views/admin_product/indexAll.php');
        return true;
    }  
}
?>