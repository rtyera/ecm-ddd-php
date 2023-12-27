<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    'health_check_get' => [[], ['_controller' => 'TyCode\\Product\\Infrastructure\\Web\\HealthCheck\\HealthCheckGetController'], [], [['text', '/health-check']], [], [], []],
    'product_create_post' => [[], ['_controller' => 'TyCode\\Product\\Infrastructure\\Web\\Product\\PostProductCreate'], [], [['text', '/product']], [], [], []],
    'product_create_cqrs_post' => [[], ['_controller' => 'TyCode\\Product\\Infrastructure\\Web\\Product\\PostProductCreateCQRS'], [], [['text', '/product-cqrs']], [], [], []],
    'product_search_get' => [['id'], ['_controller' => 'TyCode\\Product\\Infrastructure\\Web\\Product\\GetProduct'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/product']], [], [], []],
    'product_search_all_get' => [[], ['_controller' => 'TyCode\\Product\\Infrastructure\\Web\\Product\\GetProducts'], [], [['text', '/products']], [], [], []],
    'product_search_by_criteria_get' => [[], ['_controller' => 'TyCode\\Product\\Infrastructure\\Web\\Product\\GetProductByCriteria'], [], [['text', '/product-by-criteria']], [], [], []],
    'product_search_by_criteria_cqrs_get' => [[], ['_controller' => 'TyCode\\Product\\Infrastructure\\Web\\Product\\GetProductByCriteriaCQRS'], [], [['text', '/product-by-criteria-cqrs']], [], [], []],
];
