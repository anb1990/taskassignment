<?php
namespace App\Enums;

enum TaskStatus: string
{
    case TODO = 'todo';
    case IN_PROGRESS = 'in-progress';
    case DONE = 'done';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}