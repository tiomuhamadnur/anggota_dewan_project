<?php

namespace App\Http\Controllers\admin;

use App\DataTables\KabupatenDataTable;
use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function index(KabupatenDataTable $dataTable)
    {
        $provinsi = Provinsi::orderBy('name', 'ASC')->get();
        return $dataTable->render('pages.admin.kabupaten.index', compact([
            'provinsi'
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
            'provinsi_id' => 'required|numeric',
        ]);

        Kabupaten::updateOrCreate($data, $data);

        return redirect()->route('kabupaten.index')->withNotify('Data berhasil ditambahkan');
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
        $data = Kabupaten::where('uuid', $uuid)->firstOrFail();
        $rawData = $request->validate([
            'type' => 'string|required',
            'name' => 'string|required',
            'code' => 'string|required',
            'provinsi_id' => 'required|numeric',
        ]);

        $data->update($rawData);
        return redirect()->route('kabupaten.index')->withNotify('Data berhasil diubah');
    }

    public function destroy(string $uuid)
    {
        $data = Kabupaten::where('uuid', $uuid)->firstOrFail();
        $data->delete();
        return redirect()->route('kabupaten.index')->withNotify('Data berhasil dihapus');
    }
}
