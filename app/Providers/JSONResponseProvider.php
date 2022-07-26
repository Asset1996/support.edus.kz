<?php

namespace App\Providers;


class JSONResponseProvider
{
    public $headers = [];
    /**
     * Returns success.
     *
     * @return JSON
     */
    public function success(array $data = [], string $message = '', int $statusCode = 200)
    {
        return response()->json([
            'result' => True,
            'data' => $data,
            'message' => $message,
            'code' => $statusCode
        ], $statusCode)->withHeaders(
            $this->headers
        );
    }

    /**
     * Returns error.
     *
     * @return JSON
     */
    public function error($message = 'error occured', int $statusCode = 401)
    {
        return response()->json([
            'result' => False,
            'message' => $message,
            'code' => $statusCode
        ], $statusCode)->withHeaders(
            $this->headers
        );
    }

    public function withHeaders(array $headers){
        $this->headers = $headers;
        return $this;
    }
}
