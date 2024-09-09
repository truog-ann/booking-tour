<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static self ACTIVE()
 * @method static self INACTIVE()
 */
class StatusTour extends Enum
{
    public const WAITING = 0;
    public const DONE = 1;
    public const CANCEL = 2;

    public static function getArrayView(): array
    {
        return [
            self::WAITING => '<span class="badge bg-warning">Đơn mới</span>',
            self::DONE => '<span class="badge bg-success">Hoàn thành</span>',
            self::CANCEL => '<span class="badge bg-danger">Hủy</span>'

        ];
    }

    public static function getValueByKey($key): string
    {
        return self::getArrayView()[$key];
    }
}
