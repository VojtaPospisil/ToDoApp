<?php

namespace App\Helpers;

use Dotenv\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class Helper
{
    public static function generateException($exception)
    {
        if ($exception->getStatusCode() === Response::HTTP_UNPROCESSABLE_ENTITY) {
            throw new ValidationException($exception->getMessage());
        }
    }
}
