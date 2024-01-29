<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/seller/products' => [[['_route' => 'product_search_all_get', '_controller' => 'TyCode\\ms\\Seller\\Controller\\Product\\GetProducts'], null, ['GET' => 0], null, false, false, null]],
        '/seller/product-by-criteria' => [[['_route' => 'product_search_by_criteria_get', '_controller' => 'TyCode\\ms\\Seller\\Controller\\Product\\GetProductByCriteria'], null, ['GET' => 0], null, false, false, null]],
        '/seller/review' => [[['_route' => 'review_create_post', '_controller' => 'TyCode\\ms\\Seller\\Controller\\Review\\PostReviewCreate'], null, ['POST' => 0], null, false, false, null]],
        '/seller/health-check' => [[['_route' => 'seller_health_check_get', '_controller' => 'TyCode\\ms\\Seller\\Controller\\HealthCheckGetController'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/seller/product/([^/]++)(*:31)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        31 => [
            [['_route' => 'product_search_get', '_controller' => 'TyCode\\ms\\Seller\\Controller\\Product\\GetProduct'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
