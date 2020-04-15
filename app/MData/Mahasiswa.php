<?php

namespace App\MData;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $guarded = ['_token', '_method'];

    public function Transaksi()
    {
        return $this->hasMany(\App\Operational\Transaksi::class);
    }
}
