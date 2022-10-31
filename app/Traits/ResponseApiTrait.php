<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;

trait ResponseApiTrait
{
    /**
     * Default successful response.
     *
     * @param array|object|null $data The primary data.
     * @param int $statusCode Response's status code.
     * @return JsonResponse
     */
    public function successResponse(
        array|object $data = null,
        int $statusCode = 200,
    ): JsonResponse
    {
        return response()->json(['data' => $data], $statusCode);
    }

    /**
     * Response used for errors.
     *
     * @param string|null $message Error message.
     * @param array|object|null $errors An array of error objects.
     * @param int $statusCode Response's status code.
     * @return JsonResponse
     */
    public function errorResponse(
        string $message = null,
        int $statusCode = 400,
        array|object $errors = null,
    ): JsonResponse
    {
        $body = ['message' => $message];

        if ($errors !== null) $body += ['errors' => $errors];

        return response()->json($body, $statusCode);
    }

    /**
     * Response used specifically for DB Transaction errors.
     *
     * @param Exception $error Error thrown by the transaction.
     * @return JsonResponse
     */
    public function transactionErrorResponse(Exception $error): JsonResponse
    {
        if (env('APP_DEBUG')) {
            return response()->json([
                'errors' => [$error->getMessage()],
                'trace' => $error->getTrace(),
            ], 500);
        } else {
            return response()->json([
                'errors' => [$error->getMessage()],
            ], 500);
        }

    }
}
