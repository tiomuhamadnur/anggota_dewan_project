<?php

namespace App\Imports;

use App\Models\Kabupaten;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KabupatenImport implements ToModel, WithHeadingRow
{
    public $provinsi_id;

    public function __construct($provinsi_id)
    {
        $this->provinsi_id = $provinsi_id;
    }

    public function model(array $row)
    {
        return new Kabupaten([
            'provinsi_id' => $this->provinsi_id,
            'type' => $row['type'],
            'name' => $row['name'],
            'code' => $row['code'],
        ]);
    }
}
