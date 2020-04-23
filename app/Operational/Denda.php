<?php

namespace App\Operational;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    public function transaksiInformation()
    {
    	return $this->belongsTo('\App\Operational\Transaksi', 'transaksis_id');
    }
}
