<?php

namespace App;

trait ResponseTrait
{
     /**
     * Send a success response.
     *
     * @param  string|array  $data
     * @param  string  $message
     * @param  int  $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data = [], $message = null, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Send an error response.
     *
     * @param  string  $message
     * @param  int  $status
     * @param  array  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message = null, $status = 400, $errors = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
