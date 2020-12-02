<?php

namespace App\Models;

use App\Traits\HasModify;
use App\Traits\HasUuid;
use App\Traits\OverridesBuilder;
use App\Traits\ParseDateToTimestamp;
use App\Traits\SetTimeZone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use HasUuid;
    use \App\Traits\BaseModel;

    public $timestamps = false;
}
