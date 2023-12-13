<?php

namespace App\Models;

use App\Traits\RecordSignature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentPage extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;

    protected $fillable = [
        'content_en',
        'content_ar',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
