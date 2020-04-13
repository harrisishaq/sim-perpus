<?php

namespace App\MData;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $guarded = ['_token', '_method'];

    public function Buku()
    {
        return $this->hasMany(Buku::class);
    }
}
