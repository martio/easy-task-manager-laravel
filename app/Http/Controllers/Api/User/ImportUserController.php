<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\User\ImportUserRequest;
use App\Jobs\ImportUserJob;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ImportUserController extends Controller
{
    /**
     * Import a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(ImportUserRequest $request): JsonResponse
    {
        ImportUserJob::dispatchAfterResponse(
            $request->string(key: 'external_id')->value(),
        );

        return response()->json(
            data: [
                'status' => 'success',
            ],
            status: Response::HTTP_ACCEPTED);
    }
}
