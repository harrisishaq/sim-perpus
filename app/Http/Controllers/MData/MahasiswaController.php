<?php

namespace App\Http\Controllers\MData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MData\Mahasiswa;
use App\Imports\MahasiswasImport;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$mahasiswa = Mahasiswa::all()->sortBy('nim');
    	return view('mdata.mahasiswa.index', ['data'=> $mahasiswa]);
    }

    public function add()
    {
        return view('mdata.mahasiswa.add-edit', ['edit'=> false]);
    }

    public function create(Request $request)
    {
        $mahasiswa = Mahasiswa::create($request->all());
        return redirect('mdata/mahasiswa')
            ->withSuccess(__('Data Mahasiswa berhasil ditambahkan.'));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mdata.mahasiswa.add-edit', ['edit' => true, 'data'=> $mahasiswa]);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return redirect('mdata/mahasiswa')
            ->withSuccess(__('Data Mahasiswa berhasil diubah.'));
    }

    public function delete(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        Mahasiswa::destroy($id);
        return redirect('mdata/mahasiswa')
            ->withSuccess(__('Data Mahasiswa berhasil dihapus.'));
    }

    public function import() {
        Excel::import(new MahasiswasImport,request()->file('file'));
        return redirect('mdata/mahasiswa')
            ->withSuccess(__('Data Mahasiswa berhasil ditambahkan.'));
    }
}
