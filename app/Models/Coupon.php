<?php

namespace App\Models;

use App\Enums\CouponTypeEnum;
use App\Traits\RecordSignature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;

    protected $fillable = [
        'code',
        'discount',
        'type',
        'from_date',
        'to_date',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public static function getAllTypes() : array
    {
        $names  = array_column(CouponTypeEnum::cases(), 'name');
        $values = array_column(CouponTypeEnum::cases(), 'value');
        return array_combine($values, $names);
    }
}
