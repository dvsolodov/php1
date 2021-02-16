<?php

define('ROUTES', 
    [
        'admin' => [
            'controller' => 'admin/auth',
            'action' => 'login',
        ],

        'admin/logout' => [
            'controller' => 'admin/auth',
            'action' => 'logout',
        ],

        'admin/panel' => [
            'controller' => 'admin/adminPanel',
            'action' => 'showAllOrders',
        ],

        'admin/order/status/update' => [
            'controller' => 'admin/adminPanel',
            'action' => 'updateOrderStatus',
        ],

        'admin/order/(?P<orderId>\d+)/show' => [
            'controller' => 'admin/adminPanel',
            'action' => 'showCartOfOrder',
        ],

        '' => [
            'controller' => 'index',
            'action' => 'index',
        ],

        'home' => [
            'controller' => 'index',
            'action' => 'index',
        ],

        'catalog' => [
            'controller' => 'catalog',
            'action' => 'showCatalog',
        ],

        'products/(?P<id>\d+)/show' => [
            'controller' => 'product',
            'action' => 'showProduct',
        ],

        'cart' => [
            'controller' => 'cart',
            'action' => 'showCart',
        ],

        'cart/products/add' => [
            'controller' => 'cart',
            'action' => 'addProductToCart',
        ],

        'cart/products/delete' => [
            'controller' => 'cart',
            'action' => 'deleteProductFromCart',
        ],
        
        'order' => [
            'controller' => 'order',
            'action' => 'showForm',
        ],

        'order/add' => [
            'controller' => 'order',
            'action' => 'addOrder',
        ],

        'order/(?P<orderId>\d+)/show' => [
            'controller' => 'order',
            'action' => 'showCartOfOrder',
        ],

        'my-orders' => [
            'controller' => 'order',
            'action' => 'showAllOrders',
        ],

        'register' => [
            'controller' => 'auth/register',
            'action' => 'register',
        ],

        'login' => [
            'controller' => 'auth/auth',
            'action' => 'login',
        ],

        'logout' => [
            'controller' => 'auth/auth',
            'action' => 'logout',
        ],
    ]
);
