<?php

namespace App\Http\Controllers\admin;

use App\DataTables\TPSDataTable;
use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\TPS;
use Illuminate\Http\Request;

class TPSController extends Controller
{
    public function index(TPSDataTable $dataTable)
    {
        $desa = Desa::orderBy('name', 'ASC')->get();
        return $dataTable->render('pages.admin.tps.index', compact([
            'desa'
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
            'location' => 'string|required',
            'desa_id' => 'required|numeric',
        ]);

        TPS::updateOrCreate($data, $data);

        return redirect()->route('tps.index')->withNotify('Data berhasil ditambahkan');
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
        $data = TPS::where('uuid', $uuid)->firstOrFail();
        $rawData = $request->validate([
            'name' => 'string|required',
            'code' => 'string|required',
            'location' => 'string|required',
            'desa_id' => 'required|numeric',
        ]);

        $data->update($rawData);
        return redirect()->route('tps.index')->withNotify('Data berhasil diubah');
    }

    public function destroy(string $uuid)
    {
        $data = TPS::where('uuid', $uuid)->firstOrFail();
        $data->delete();
        return redirect()->route('tps.index')->withNotify('Data berhasil dihapus');
    }
}
