<?php

namespace App\Http\CustomResponse;

use Illuminate\Http\JsonResponse;

class CustomJsonResponse extends JsonResponse
{
    public function __construct($data = null, $status = 200, $headers = [], $options = 0)
    {
        // Define your default response structure here

        parent::__construct($data, $status, $headers, $options);
    }
}
