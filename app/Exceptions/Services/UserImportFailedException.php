<?php

declare(strict_types=1);

namespace App\Exceptions\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException as Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Exceptions.
 */
class UserImportFailedException extends Exception
{
    /**
     * Create a new exception.
     */
    public function __construct(
        private readonly string $externalId,
        private readonly string $responseBody,
        ?Throwable $previous = null,
    ) {
        parent::__construct(
            message: 'Failed to import user.',
            previous: $previous,
        );
    }

    /**
     * Get the external ID.
     */
    public function externalId(): string
    {
        return $this->externalId;
    }

    /**
     * Get the response body.
     */
    public function responseBody(): string
    {
        return $this->responseBody;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(data: [
            'status' => 'failure',
            'message' => 'user_import_failed',
        ], status: Response::HTTP_BAD_GATEWAY);
    }

    /**
     * Get the exception's context information.
     *
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return [
            'external_id' => $this->externalId,
            'response_body' => $this->responseBody,
        ];
    }
}
