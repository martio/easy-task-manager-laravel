<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException as Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Exceptions.
 */
class ResourceNotFoundException extends Exception
{
    /**
     * Create a new exception.
     */
    public function __construct(
        private readonly string $type,
        private readonly ?string $column = null,
        private readonly int|string|null $value = null,
        ?Throwable $previous = null,
    ) {
        parent::__construct(
            message: 'The resource does not exist.',
            previous: $previous,
        );
    }

    /**
     * Get the type of resource.
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * Get the column of resource.
     */
    public function column(): ?string
    {
        return $this->column;
    }

    /**
     * Get the value of resource.
     */
    public function value(): int|string|null
    {
        return $this->value;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(data: [
            'status' => 'failure',
            'message' => 'resource_not_found',
        ], status: Response::HTTP_NOT_FOUND);
    }

    /**
     * Get the exception's context information.
     *
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return [
            'type' => $this->type,
            'column' => $this->column,
            'value' => $this->value,
        ];
    }
}
