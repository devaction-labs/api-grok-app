<?php

namespace App\Enum\Queue;

/**
 * @property string $value
 */
enum QueuePriorityEnum: string
{
    case LOW        = 'low';
    case HIGH       = 'high';
    case LONGTIME   = 'long-timeout';
    case ONBOARDING = 'onboarding';
}
