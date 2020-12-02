<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            /**@var $model Model */
            if (! $model->getKey()) {
                if (DB::getSchemaBuilder()->getColumnType($model->getTable(), $model->getKeyName()) != 'integer') {
                    $model->{$model->getKeyName()} = (string) Str::uuid();
                }
            }
        });
    }

    /**
     * @inheritDoc
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getKeyType()
    {
        return 'string';
    }
}
