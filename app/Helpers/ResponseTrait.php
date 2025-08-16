<?php

namespace App\Helpers;

trait ResponseTrait
{
    public function json(mixed $data = null, $message = '', $status = 200, $header = [])
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status, $header);
    }
}
