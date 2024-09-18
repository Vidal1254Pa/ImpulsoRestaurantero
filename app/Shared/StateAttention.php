<?php

namespace App\Shared;

enum StateAttention: string
{
    case PENDING = 'pending';
    case CONTACTED = 'contacted';
    case SCHEDULED = 'scheduled';
    case CANCELED = 'canceled';
}
