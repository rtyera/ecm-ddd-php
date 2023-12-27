<?php

use TyCode\ms\Shop\ShopKernel;

require_once dirname(__DIR__).'/../bootstrap.php';

return function (array $context) {
    return new ShopKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
