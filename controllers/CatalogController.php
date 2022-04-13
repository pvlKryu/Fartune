<?php

//include_once ROOT.'/models/Cafe.php';
//include_once ROOT.'/models/Product.php';

class CatalogController
{
    public function actionCafe($cafeId)
    {
        $cafes=array();
        $cafes=Cafe::getCafeList();
        
        $cafe=array();
        $cafe=Cafe::getCafeById($cafeId);

        $cafeProducts = array();
        $cafeProducts = Product::getProductsListByCafe($cafeId);

        require_once(ROOT.'/views/catalog/cafe.php');

        return true;
    }
}
?>