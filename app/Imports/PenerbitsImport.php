<?php

namespace App\Imports;

use App\MData\Penerbit;
use Maatwebsite\Excel\Concerns\ToModel;

class PenerbitsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Penerbit([
            'nama' => $row[0],
            // 'nama' => $row[1],
        ]);
    }
}
