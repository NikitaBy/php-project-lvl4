<?php

declare(strict_types=1);

namespace App\Enum;

class TaskStatusNameEnum
{
    public const TASK_STATUS_NEW = 'new';
    public const TASK_STATUS_IN_PROCESS = 'in_process';
    public const TASK_STATUS_IN_TEST = 'in_test';
    public const TASK_STATUS_COMPLETE = 'complete';

    public static function list()
    {
        return [
            self::TASK_STATUS_NEW,
            self::TASK_STATUS_IN_PROCESS,
            self::TASK_STATUS_IN_TEST,
            self::TASK_STATUS_COMPLETE,
        ];
    }
}
