<?php 

namespace App\Traits;
use myConstant;

trait MessageTrait{

    protected function successMessage($message,$data)
    {
        return response()->json([
            'message' => $message,
            'status' => 'success',
            'data' => $data
        ],myConstant::HTTP_OK);
    }

    protected function errorMessage($message)
    {
        return response()->json([
            'message' => $message,
            'status' => 'error',
        ],myConstant::HTTP_BAD_REQUEST);
    }

}