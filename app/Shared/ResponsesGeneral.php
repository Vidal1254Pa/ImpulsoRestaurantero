<?php

namespace App\Shared;

enum ResponsesGeneral: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
    case WARNING = 'warning';
    case INFO = 'info';
}
