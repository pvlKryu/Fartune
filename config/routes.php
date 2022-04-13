<?php
return array(
    'cafe/([0-9]+)'=>'catalog/cafe/$1', //actionCafe в CatalogController

    //'cart/add/([0-9]+)'=>'cart/add/$1',
    //'cart/remove/([0-9]+)'=>'cart/remove/$1',
    'cart/addAjax/([0-9]+)'=>'cart/addAjax/$1',
    'cart/removeAjax/([0-9]+)'=>'cart/removeAjax/$1',
    
    //'cart/total'=>'cart/total', //итоговая сумма в корзине
    'cart/totalSum'=>'cart/totalAjax', //итоговая сумма в корзине
    'cart/cansel'=>'cart/cansel', //отменить заказ
    'cart'=>'cart/index', //корзина

    'user/register' => 'user/register',
    'login/user' => 'user/login',
    //'login/cafe' => 'cafe/login',
    'login' => 'user/choice',
    'logout' => 'user/logout',

    'cabinet/editPassword'=>'cabinet/editPassword',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet/orders' => 'cabinet/orders', //список заказов клиента
    'cabinet' => 'cabinet/index',
    
    //Админ
    //Админ заказы
    'admin/order/delete/([0-9]+)'=>'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)'=>'adminOrder/view/$1',
    'admin/order/([0-9]+)'=>'adminOrder/index/$1',
    'admin/order/all'=>'adminOrder/indexAll',
    'admin/order'=>'adminOrder/indexChoice',
    
    //Админ товары
    'admin/product/create'=>'adminProduct/create',
    'admin/product/update/([0-9]+)'=>'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)'=>'adminProduct/delete/$1',
    'admin/product/([0-9]+)'=>'adminProduct/index/$1',
    'admin/product/all'=>'adminProduct/indexAll',
    'admin/product'=>'adminProduct/indexChoice',

    //Админ кафе
    'admin/cafe/create'=>'adminCafe/create',
    'admin/cafe/update/([0-9]+)'=>'adminCafe/update/$1',
    'admin/cafe/delete/([0-9]+)'=>'adminCafe/delete/$1',
    'admin/cafe'=>'adminCafe/index',

    //Админ пользователи
    //Админ пользователи - работники кафе
    'admin/user/employee/create'=>'adminUserCafe/create',
    'admin/user/employee/update/([0-9]+)'=>'adminUserCafe/update/$1',
    'admin/user/employee/password/([0-9]+)'=>'adminUserCafe/password/$1',
    'admin/user/employee/delete/([0-9]+)'=>'adminUserCafe/delete/$1',
    'admin/user/employee/([0-9]+)'=>'adminUserCafe/index/$1',//работники по кафе
    'admin/user/employee/all'=>'adminUserCafe/indexAll',//все работники
    'admin/user/employee'=>'adminUserCafe/indexChoice',//выбор кафе работников
    
    //Админ пользователи - клиенты
    'admin/user/customer/create'=>'adminUser/create',
    'admin/user/customer/update/([0-9]+)'=>'adminUser/update/$1',
    'admin/user/customer/password/([0-9]+)'=>'adminUser/password/$1',
    'admin/user/customer/orders/([0-9]+)'=>'adminUser/orders/$1',
    'admin/user/customer/delete/([0-9]+)'=>'adminUser/delete/$1',
    'admin/user/customer'=>'adminUser/index',

    'admin/user'=>'adminUser/indexChoice',

    //АдминПанель
    'admin'=>'admin/index',

    //сайт
    ''=>'site/index', //actionIndex в SiteController
);
?>