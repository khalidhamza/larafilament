<?php

namespace App\Models;

use App\Traits\RecordSignature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;

    protected $fillable = [
        'name_en',
        'name_ar',
        'delivery_partner_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function deliveryPartner() : HasOne
    {
        return $this->hasOne(DeliveryPartner::class,  'id', 'delivery_partner_id');
    }
}
