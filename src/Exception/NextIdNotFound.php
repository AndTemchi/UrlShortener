<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class NextIdNotFound extends HttpException
{
    const MESSAGE = "Next id not found";

    public function __construct(string $message = '', \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct(500, self::MESSAGE, $previous, $headers, $code);
    }
}