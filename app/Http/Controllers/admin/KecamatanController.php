<?php

namespace App\Http\Controllers\admin;

use App\DataTables\KecamatanDataTable;
use App\Exports\KecamatanExport;
use App\Http\Controllers\Controller;
use App\Imports\KecamatanImport;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            Excel::import(new KecamatanImport(), $file);
        }

        return redirect()->route('kecamatan.index')->withNotify('Data berhasil diimport');
    }

    public function export()
    {
        $waktu = Carbon::now()->format('Ymd');
        $name = $waktu . '_Data Kecamatan.xlsx';

        return Excel::download(new KecamatanExport(), $name, \Maatwebsite\Excel\Excel::XLSX);
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
