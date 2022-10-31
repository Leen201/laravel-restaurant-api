<?php
namespace App\Enums\Order;

enum StatusEnum: string
{
    case Opened = 'opened';
    case Closed = 'closed';
}
