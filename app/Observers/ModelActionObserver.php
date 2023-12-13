<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ModelActionObserver
{

    public function creating(Model $model)
    {
        if (Schema::hasColumn($model->getTable(), 'created_by')) {
            // $model->update(['created_by' => auth('admin')->user()->id ?? 0]);
            $model->created_by = auth('admin')->user()->id ?? 0;
        }
    }

    public function updating(Model $model)
    {
        if (Schema::hasColumn($model->getTable(), 'updated_by')) {
            // $model->update(['updated_by' => auth('admin')->user()->id ?? 0]);
            Log::info("Update", [$model]);
            $model->updated_by = auth('admin')->user()->id ?? 0;
        }
    }

    public function deleting(Model $model)
    {
        if (Schema::hasColumn($model->getTable(), 'deleted_by')) {
            $model->update(['deleted_by' => auth('admin')->user()->id ?? 0]);
        }
    }
}
