<?php

//include_once ROOT.'/models/Cafe.php';

class SiteController
{
    public function actionIndex()
    {
        $cafes=array();
        $cafes=Cafe::getCafeList();

        require_once(ROOT.'/views/site/index.php');

        return true;
    }
}
?>