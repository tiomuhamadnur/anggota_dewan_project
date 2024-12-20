<?php

namespace App\Http\Controllers\admin;

use App\DataTables\KabupatenDataTable;
use App\Exports\KabupatenExport;
use App\Http\Controllers\Controller;
use App\Imports\KabupatenImport;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function import(Request $request)
    {
        $request->validate([
            'provinsi_id' => 'required|numeric',
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $provinsi_id = $request->provinsi_id;

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            Excel::import(new KabupatenImport($provinsi_id), $file);
        }

        return redirect()->route('kabupaten.index')->withNotify('Data berhasil diimport');
    }

    public function export()
    {
        $waktu = Carbon::now()->format('Ymd');
        $name = $waktu . '_Data Kabupaten & Kota.xlsx';

        return Excel::download(new KabupatenExport(), $name, \Maatwebsite\Excel\Excel::XLSX);
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
