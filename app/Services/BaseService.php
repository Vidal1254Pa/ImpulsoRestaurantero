<?php

namespace App\Services;

use App\Services\Processors\ResponseProcessors;
use App\Shared\ResponsesGeneral;
use Illuminate\Http\Response;

class BaseService
{
    public function startService(
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
        return ResponseProcessors::getInstance()->execute(
            callback: $callback,
            params: $params,
            onErrorMessage: $onErrorMessage,
            onSuccessMessage: $onSuccessMessage,
            defaultCode: $defaultCode,
            processHasReturnValue: $processHasReturnValue,
            injectedReturnValueOnKey: $injectedReturnValueOnKey,
            callableIsForReturnDataWithOutMessage: $callableIsForReturnDataWithOutMessage,
            generateExceptionOn: $generateExceptionOn,
            dependensOn: $dependensOn
        );
    }
}
