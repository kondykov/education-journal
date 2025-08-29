<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class AppException extends Exception
{
    protected array $details;
    protected ?string $userMessage;

    public function __construct(
        string    $message = '',
        int       $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        array     $details = [],
        ?string   $userMessage = null,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);

        $this->details = $details;
        $this->userMessage = $userMessage ?? $message;
    }

    public function getErrorCode(): string
    {
        return $this->code;
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public function getUserMessage(): string
    {
        return $this->userMessage;
    }

    public function report(): void
    {
        logger()->error($this->getMessage(), [
            'error_code' => $this->code,
            'details' => $this->details,
            'trace' => $this->getTrace(),
        ]);
    }

    public function render(Request $request): JsonResponse|Response
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => $this->code,
                    'message' => $this->userMessage,
                    'details' => $this->details,
                ],
                'timestamp' => now()->toISOString(),
            ], $this->getCode());
        }

        return response()->json([
            'message' => $this->userMessage,
            'code' => $this->getCode(),
        ], $this->getCode());
    }
}
