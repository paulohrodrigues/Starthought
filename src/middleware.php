<?php
use Respect\Validation\Validator as v;

$app->add(new middleware\CarregaDadosMiddleware($container));
$app->add(new middleware\CsrfViewMiddleware($container));
$app->add(new middleware\ValidadorErrosMiddleware($container));
$app->add($container->csrf);


v::with("validador\\Rules\\");