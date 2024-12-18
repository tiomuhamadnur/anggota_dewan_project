<?php

namespace App\Http\Controllers\admin;

use App\DataTables\KecamatanDataTable;
use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index(KecamatanDataTable $dataTable)
    {
        $kabupaten = Kabupaten::orderBy('name', 'ASC')->get();
        return $dataTable->render('pages.admin.kecamatan.index', compact([
            'kabupaten'
        ]));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'code' => 'string|required',
            'kabupaten_id' => 'required|numeric',
        ]);

        Kecamatan::updateOrCreate($data, $data);

        return redirect()->route('kecamatan.index')->withNotify('Data berhasil ditambahkan');
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
        $data = Kecamatan::where('uuid', $uuid)->firstOrFail();
        $rawData = $request->validate([
            'name' => 'string|required',
            'code' => 'string|required',
            'provinsi_id' => 'required|numeric',
        ]);

        $data->update($rawData);
        return redirect()->route('kecamatan.index')->withNotify('Data berhasil diubah');
    }

    public function destroy(string $uuid)
    {
        $data = Kecamatan::where('uuid', $uuid)->firstOrFail();
        $data->delete();
        return redirect()->route('kecamatan.index')->withNotify('Data berhasil dihapus');
    }
}
