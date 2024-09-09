<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static self ACTIVE()
 * @method static self INACTIVE()
 */
class StatusPayment extends Enum
{
    public const PENDING = 0;
    public const PAID = 1;
    public const CANCEL = 2;
    public const REFUND = 3;

    public static function getArrayView(): array
    {
        return [
            self::PENDING => '<span class="badge bg-warning">Chưa thanh toán</span>',
            self::PAID => '<span class="badge bg-success">Đã thanh toán</span>',
            self::CANCEL => '<span class="badge bg-danger">Hủy</span>',
            self::REFUND => '<span class="badge bg-info">Hoàn tiền</span>'

        ];
    }

    public static function getValueByKey($key): string
    {
        return self::getArrayView()[$key];
    }
}
