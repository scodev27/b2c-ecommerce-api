<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/doc.json' => [[['_route' => 'app.swagger', '_controller' => 'nelmio_api_doc.controller.swagger'], null, ['GET' => 0], null, false, false, null]],
        '/api/doc' => [[['_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'], null, ['GET' => 0], null, false, false, null]],
        '/admin' => [[['_route' => 'app_admin', '_controller' => 'App\\Controller\\AdminController::index'], null, null, null, false, false, null]],
        '/api/products' => [[['_route' => 'api_products_list', '_controller' => 'App\\Controller\\Api\\ProductApiController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/order' => [[['_route' => 'api_make_order', '_controller' => 'App\\Controller\\Api\\ProductApiController::makeOrder'], null, ['POST' => 0], null, false, false, null]],
        '/cart' => [[['_route' => 'app_cart', '_controller' => 'App\\Controller\\CartController::index'], null, null, null, false, false, null]],
        '/checkout' => [[['_route' => 'app_checkout', '_controller' => 'App\\Controller\\CheckoutController::index'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/a(?'
                    .'|dmin/order/([^/]++)/status/([^/]++)(*:82)'
                    .'|pi/products/([^/]++)(*:109)'
                .')'
                .'|/c(?'
                    .'|art/(?'
                        .'|add/([^/]++)(*:142)'
                        .'|remove/([^/]++)(*:165)'
                    .')'
                    .'|heckout/success/([^/]++)(*:198)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        82 => [[['_route' => 'admin_order_status', '_controller' => 'App\\Controller\\AdminController::updateStatus'], ['id', 'status'], null, null, false, true, null]],
        109 => [[['_route' => 'api_product_detail', '_controller' => 'App\\Controller\\Api\\ProductApiController::detail'], ['id'], ['GET' => 0], null, false, true, null]],
        142 => [[['_route' => 'cart_add', '_controller' => 'App\\Controller\\CartController::add'], ['id'], null, null, false, true, null]],
        165 => [[['_route' => 'cart_remove', '_controller' => 'App\\Controller\\CartController::remove'], ['id'], null, null, false, true, null]],
        198 => [
            [['_route' => 'app_checkout_success', '_controller' => 'App\\Controller\\CheckoutController::success'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
