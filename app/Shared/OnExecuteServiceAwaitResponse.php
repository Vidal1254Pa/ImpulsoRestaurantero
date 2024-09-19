<?php

namespace App\Shared;

use Illuminate\Http\Response;

class OnExecuteServiceAwaitResponse
{
    public static function success($message = ResponsesGeneral::SUCCESS, $code = Response::HTTP_OK, bool $withOutMessage = false, array $dataInjected = [])
    {
        if ($withOutMessage) {
            return response()->json($dataInjected, $code);
        } else {
            $dataReturned = [];
            if (count($dataInjected) == 0) {
                $dataReturned = ['message' => $message];
            } else {
                $dataReturned = ['message' => $message, ...$dataInjected];
            }
            return response()->json([
                ...$dataReturned
            ], $code);
        }
    }

    public static function error($message = ResponsesGeneral::ERROR, $error = 'error inesperado', $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'message' => $message,
            'error' => $error
        ], $code);
    }
}
