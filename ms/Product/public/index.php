<?php

use Symfony\Component\HttpFoundation\Request;
use TyCode\ms\Product\ProductKernel;

require_once dirname(__DIR__).'/../bootstrap.php';

return function (array $context) {
    return new ProductKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

// $kernel   = new ProductKernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
// $request  = Request::createFromGlobals();
// $response = $kernel->handle($request);
// $response->send();
// $kernel->terminate($request, $response);
