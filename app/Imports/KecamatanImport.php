<?php

namespace App\Imports;

use App\Models\Kecamatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KecamatanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Kecamatan([
            'kabupaten_id' => $row['kabupaten_id'],
            'name' => $row['name'],
            'code' => $row['code'],
        ]);
    }
}
