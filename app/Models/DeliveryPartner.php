<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'integration_name',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
