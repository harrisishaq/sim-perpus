<?php

namespace App\Operational;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	protected $guarded = ['_token', '_method'];

    public function mahasiswaInformation()
    {
    	return $this->belongsTo('\App\MData\Mahasiswa', 'mahasiswas_id');
    }

    public function bukuInformation()
    {
    	return $this->belongsTo('\App\MData\Buku', 'bukus_id');
    }

    public function Denda()
    {
        return $this->hasOne(\App\Operational\Transaksi::class);
    }
}
