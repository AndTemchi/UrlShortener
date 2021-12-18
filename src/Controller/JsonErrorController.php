<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

class JsonErrorController
{
    public function show(Throwable $exception)
    {
        $code = ($exception->getCode() < 100) ? 500 : $exception->getCode();
        return new JsonResponse($exception->getMessage(), $code);
    }
}