<?php

namespace App\MData;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $guarded = ['_token', '_method'];

    public function penerbit()
    {
    	return $this->belongsTo('\App\MData\Penerbit', 'penerbits_id');
    }

    public function Transaksi()
    {
        return $this->hasMany(\App\Operational\Transaksi::class);
    }
}
