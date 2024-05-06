<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/shop/product' => [[['_route' => 'product_create_post', '_controller' => 'TyCode\\ms\\Shop\\Controller\\Product\\PostProductCreate'], null, ['POST' => 0], null, false, false, null]],
        '/shop/products' => [[['_route' => 'product_search_all_get', '_controller' => 'TyCode\\ms\\Shop\\Controller\\Product\\GetProducts'], null, ['GET' => 0], null, false, false, null]],
        '/shop/product-by-criteria' => [[['_route' => 'product_search_by_criteria_get', '_controller' => 'TyCode\\ms\\Shop\\Controller\\Product\\GetProductByCriteria'], null, ['GET' => 0], null, false, false, null]],
        '/shop/health-check' => [[['_route' => 'shop_health_check_get', '_controller' => 'TyCode\\ms\\Shop\\Controller\\HealthCheckGetController'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/shop/(?'
                    .'|product/([^/]++)(*:32)'
                    .'|review/([^/]++)(?'
                        .'|(*:57)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        32 => [[['_route' => 'product_search_get', '_controller' => 'TyCode\\ms\\Shop\\Controller\\Product\\GetProduct'], ['id'], ['GET' => 0], null, false, true, null]],
        57 => [
            [['_route' => 'review_checker_put', '_controller' => 'TyCode\\ms\\Shop\\Controller\\Review\\PutCheckerReview'], ['product_id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'review_search_get', '_controller' => 'TyCode\\ms\\Shop\\Controller\\Review\\GetReviewByProductId'], ['product_id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
