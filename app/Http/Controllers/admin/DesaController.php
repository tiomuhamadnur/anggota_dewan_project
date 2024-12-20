<?php

namespace App\Http\Controllers\admin;

use App\DataTables\DesaDataTable;
use App\Exports\KecamatanExport;
use App\Http\Controllers\Controller;
use App\Imports\KecamatanImport;
use App\Models\Desa;
use App\Models\Kecamatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DesaController extends Controller
{
    public function index(DesaDataTable $dataTable)
    {
        $kecamatan = Kecamatan::orderBy('name', 'ASC')->get();
        return $dataTable->render('pages.admin.desa.index', compact([
            'kecamatan'
        ]));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'string|required',
            'name' => 'string|required',
            'code' => 'string|required',
            'kecamatan_id' => 'required|numeric',
        ]);

        Desa::updateOrCreate($data, $data);

        return redirect()->route('desa.index')->withNotify('Data berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $uuid)
    {
        $data = Desa::where('uuid', $uuid)->firstOrFail();
        $rawData = $request->validate([
            'type' => 'string|required',
            'name' => 'string|required',
            'code' => 'string|required',
            'kecamatan_id' => 'required|numeric',
        ]);

        $data->update($rawData);
        return redirect()->route('desa.index')->withNotify('Data berhasil diubah');
    }

    public function destroy(string $uuid)
    {
        $data = Desa::where('uuid', $uuid)->firstOrFail();
        $data->delete();
        return redirect()->route('desa.index')->withNotify('Data berhasil dihapus');
    }
}
