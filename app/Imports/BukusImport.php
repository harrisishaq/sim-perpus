<?php

namespace App\Imports;

use App\Buku;
use Maatwebsite\Excel\Concerns\ToModel;

class BukusImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Buku([
            //
        ]);
    }
}
