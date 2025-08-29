<?php
declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;
use Throwable;

class EntityExistsExceptions extends AppException
{
    public function __construct(
        string $message = '',
        int $code = Response::HTTP_BAD_REQUEST,
        array $details = [],
        ?string $userMessage = null,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $details, $userMessage, $previous);
    }
}
