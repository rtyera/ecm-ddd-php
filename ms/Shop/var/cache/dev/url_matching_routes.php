<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/product' => [[['_route' => 'product_create_post', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\PostProductCreate'], null, ['POST' => 0], null, false, false, null]],
        '/product-health-check' => [[['_route' => 'product_health_check_get', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\HealthCheckGetController'], null, ['GET' => 0], null, false, false, null]],
        '/products' => [[['_route' => 'product_search_all_get', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\GetProducts'], null, ['GET' => 0], null, false, false, null]],
        '/product-by-criteria' => [[['_route' => 'product_search_by_criteria_get', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\GetProductByCriteria'], null, ['GET' => 0], null, false, false, null]],
        '/review-health-check' => [[['_route' => 'review_health_check_get', '_controller' => 'TyCode\\Shop\\Review\\Infrastructure\\Web\\HealthCheckGetController'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/product/([^/]++)(*:24)'
                .'|/review/([^/]++)(?'
                    .'|(*:50)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        24 => [[['_route' => 'product_search_get', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\GetProduct'], ['id'], ['GET' => 0], null, false, true, null]],
        50 => [
            [['_route' => 'review_checker_put', '_controller' => 'TyCode\\Shop\\Review\\Infrastructure\\Web\\PutCheckerReview'], ['product_id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'review_search_get', '_controller' => 'TyCode\\Shop\\Review\\Infrastructure\\Web\\GetReviewByProductId'], ['product_id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
