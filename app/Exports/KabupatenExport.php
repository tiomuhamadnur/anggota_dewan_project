<?php

namespace App\Exports;

use App\Models\Kabupaten;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KabupatenExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $data = Kabupaten::all();

        return view('pages.admin.kabupaten.export', [
            'data' => $data,
        ]);
    }
}
