<?php

namespace App\Imports;

use App\MData\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mahasiswa([
            'nim' => $row[0],
            'nama' => $row[1],
            'email' => $row[2],
            'no_hp' => $row[3],
        ]);
    }
}
