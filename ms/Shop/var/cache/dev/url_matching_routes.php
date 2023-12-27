<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/health-check' => [[['_route' => 'health_check_get', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\HealthCheck\\HealthCheckGetController'], null, ['GET' => 0], null, false, false, null]],
        '/product' => [[['_route' => 'product_create_post', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\Product\\PostProductCreate'], null, ['POST' => 0], null, false, false, null]],
        '/product-cqrs' => [[['_route' => 'product_create_cqrs_post', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\Product\\PostProductCreateCQRS'], null, ['POST' => 0], null, false, false, null]],
        '/products' => [[['_route' => 'product_search_all_get', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\Product\\GetProducts'], null, ['GET' => 0], null, false, false, null]],
        '/product-by-criteria' => [[['_route' => 'product_search_by_criteria_get', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\Product\\GetProductByCriteria'], null, ['GET' => 0], null, false, false, null]],
        '/product-by-criteria-cqrs' => [[['_route' => 'product_search_by_criteria_cqrs_get', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\Product\\GetProductByCriteriaCQRS'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/product/([^/]++)(*:24)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        24 => [
            [['_route' => 'product_search_get', '_controller' => 'TyCode\\Shop\\Product\\Infrastructure\\Web\\Product\\GetProduct'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
