<?php

namespace App\Models;

use App\Traits\RecordSignature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;

    protected $fillable = [
        'name',
        'url',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
