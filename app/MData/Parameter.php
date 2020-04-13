<?php

namespace App\MData;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $guarded = ['_token', '_method'];
}
