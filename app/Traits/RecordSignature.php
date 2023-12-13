<?php
namespace App\Traits;

use App\Observers\ModelActionObserver;

trait RecordSignature
{
    public static function boot(): void
    {
        parent::boot();
        static::observe(ModelActionObserver::class);
    }
}