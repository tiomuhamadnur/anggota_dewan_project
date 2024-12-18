<?php

namespace App\Http\Controllers\admin;

use App\DataTables\ProvinsiDataTable;
use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index(ProvinsiDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.provinsi.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'code' => 'string|required'
        ]);

        Provinsi::updateOrCreate($data, $data);

        return redirect()->route('provinsi.index')->withNotify('Data berhasil ditambahkan');
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
        $data = Provinsi::where('uuid', $uuid)->firstOrFail();
        $rawData = $request->validate([
            'name' => 'string|required',
            'code' => 'string|required'
        ]);

        $data->update($rawData);
        return redirect()->route('provinsi.index')->withNotify('Data berhasil diubah');
    }

    public function destroy(string $uuid)
    {
        $data = Provinsi::where('uuid', $uuid)->firstOrFail();
        $data->delete();
        return redirect()->route('provinsi.index')->withNotify('Data berhasil dihapus');
    }
}
