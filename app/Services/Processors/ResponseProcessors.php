<?php

namespace App\Services\Processors;

use App\Shared\ResponsesGeneral;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class ResponseProcessors
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ResponseProcessors();
        }
        return self::$instance;
    }

    private function onSuccess($message = ResponsesGeneral::SUCCESS, array $dataInjected = [], $code = 200, bool $callableIsForReturnDataWithOutMessage = false)
    {
        if ($callableIsForReturnDataWithOutMessage) {
            return response()->json($dataInjected, $code);
        }
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

    private function onError($message = ResponsesGeneral::ERROR, $error = 'error inesperado', $code = 400)
    {
        return response()->json([
            'message' => $message,
            'error' => $error
        ], $code);
    }

    public function execute(
        callable $callback,
        String $onErrorMessage,
        ResponsesGeneral $onSuccessMessage,
        int $defaultCode = Response::HTTP_OK,
        bool $processHasReturnValue = false,
        array $injectedReturnValueOnKey = [],
        bool $callableIsForReturnDataWithOutMessage = false,
        callable $generateExceptionOn = null,
        callable $dependensOn = null,
        array $params
    ) {
        try {
            $data = call_user_func_array($callback, $params);
            $keysInjected = [];
            if ($processHasReturnValue) {
                foreach ($injectedReturnValueOnKey as $itemKey) {
                    if ($data instanceof int) {
                        $keysInjected[$itemKey] = $data[$itemKey];
                    } else {
                        if ($generateExceptionOn !== null && $data === null) {
                            call_user_func($generateExceptionOn, ...$params);
                        } else {
                            if ($data instanceof Model) {
                                $keysInjected[$itemKey] = $data[$itemKey];
                            } else if ($data instanceof Collection) {
                                $keysInjected[$itemKey] = $data;
                            }
                        }
                    }
                }
            }
            return $this->onSuccess(
                message: $onSuccessMessage,
                dataInjected: $keysInjected,
                code: $defaultCode,
                callableIsForReturnDataWithOutMessage: $callableIsForReturnDataWithOutMessage
            );
        } catch (\Exception $e) {
            return $this->onError(
                message: $onErrorMessage,
                error: $e->getMessage(),
                code: $e->getCode()
            );
        }
    }
}
