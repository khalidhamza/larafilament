<?php
namespace App\Enums;

enum CouponTypeEnum : string
{
    case FIXED      = 1;
    case PERCENTAGE = 2;

    public static function fromName(string $name): string
    {
        foreach (self::cases() as $status) {
            if( $name === $status->name ){
                return $status->value;
            }
        }
        return '';
    }
}