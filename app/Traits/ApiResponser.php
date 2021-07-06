<?php


namespace App\Traits;


trait ApiResponser
{

    public function success($data, string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function error($data = null, string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }


}
