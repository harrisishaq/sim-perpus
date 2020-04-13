<?php

namespace App\MData;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $guarded = ['_token', '_method'];
}
