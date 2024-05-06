<?php

use TyCode\ms\Seller\SellerKernel;

require_once dirname(__DIR__).'/../bootstrap.php';

return function (array $context) {
    return new SellerKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
