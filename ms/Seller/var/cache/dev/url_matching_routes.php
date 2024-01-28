<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/product-health-check' => [[['_route' => 'seller_health_check_get', '_controller' => 'TyCode\\Seller\\Product\\Infrastructure\\Web\\HealthCheckGetController'], null, ['GET' => 0], null, false, false, null]],
        '/products' => [[['_route' => 'product_search_all_get', '_controller' => 'TyCode\\Seller\\Product\\Infrastructure\\Web\\GetProducts'], null, ['GET' => 0], null, false, false, null]],
        '/product-by-criteria' => [[['_route' => 'product_search_by_criteria_get', '_controller' => 'TyCode\\Seller\\Product\\Infrastructure\\Web\\GetProductByCriteria'], null, ['GET' => 0], null, false, false, null]],
        '/review' => [[['_route' => 'review_create_post', '_controller' => 'TyCode\\Seller\\Review\\Infrastructure\\Web\\PostReviewCreate'], null, ['POST' => 0], null, false, false, null]],
        '/review-health-check' => [[['_route' => 'review_health_check_get', '_controller' => 'TyCode\\Seller\\Review\\Infrastructure\\Web\\HealthCheckGetController'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/product/([^/]++)(*:24)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        24 => [
            [['_route' => 'product_search_get', '_controller' => 'TyCode\\Seller\\Product\\Infrastructure\\Web\\GetProduct'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
