<?php
class AdminCafeController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin(); //Проверка доступа

        $cafes=array();
        $cafes=Cafe::getCafeList();

        require_once(ROOT.'/views/admin_cafe/index.php');
        return true;
    }  

    public function actionCreate()
    {
        self::checkAdmin(); //Проверка доступа

        if (isset($_POST['submit']))
        {
            $options['name']=$_POST['name'];
            $options['status']=$_POST['status'];
            $options['address']=$_POST['address'];

            $errors=false;

            // if(!isset($options['name']) || empty($options['name'])) $errors[]='Заполните поля';

            if($errors==false)
            {
                $id=Cafe::createCafe($options);

                if ($id)
                {
                    if (is_uploaded_file($_FILES["image"]["tmp_name"]))
                    {
                        //загрузка нового файла
                        $fileName=$_FILES["image"]["name"];
                        $fileNameCmps=explode(".", $fileName);
                        $type=strtolower(end($fileNameCmps));

                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/upload/images/cafe/{$id}.{$type}");
                    }
                }
            }

            header("Location: /admin/cafe");
        }

        require_once(ROOT.'/views/admin_cafe/create.php');
        return true;
    }  

    public function actionUpdate($id)
    {
        self::checkAdmin(); //Проверка доступа

        $cafe=array();
        $cafe=Cafe::getCafeById($id);

        if (isset($_POST['submit']))
        {
            $options['name']=$_POST['name'];
            $options['status']=$_POST['status'];
            $options['address']=$_POST['address'];

            if(Cafe::updateCafeById($id,$options))
            {
                if (is_uploaded_file($_FILES["image"]["tmp_name"]))
                {
                    //удаление существующего файла
                    $existimage=Cafe::getImage($id);
                    if ($existimage!='/upload/images/cafe/no-image.jpg')
                        unlink($_SERVER['DOCUMENT_ROOT']."{$existimage}");

                    //загрузка нового файла
                    $fileName=$_FILES["image"]["name"];
                    $fileNameCmps=explode(".", $fileName);
                    $type=strtolower(end($fileNameCmps));

                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/upload/images/cafe/{$id}.{$type}");
                }
            }

            header("Location: /admin/cafe");
        }

        require_once(ROOT.'/views/admin_cafe/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin(); //Проверка доступа
        $cafe=Cafe::getCafeById($id);

        if(isset($_POST['submit']))
        {   
            Cafe::deleteCafeById($id);

            header("Location: /admin/cafe");
        }

        require_once(ROOT.'/views/admin_cafe/delete.php');
        return true;
    } 

}
?>