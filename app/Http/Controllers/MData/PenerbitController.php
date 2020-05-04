<?php

namespace App\Http\Controllers\MData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MData\Penerbit;
use App\Imports\PenerbitsImport;
use Maatwebsite\Excel\Facades\Excel;

class PenerbitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$penerbit = Penerbit::all();
    	return view('mdata.penerbit.index', ['data'=> $penerbit]);
    }

    public function add()
    {
        return view('mdata.penerbit.add-edit', ['edit'=> false]);
    }

    public function create(Request $request)
    {
        $penerbit = Penerbit::create($request->all());
        return redirect('mdata/penerbit')
            ->withSuccess(__('Data Penerbit berhasil ditambahkan.'));
    }

    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('mdata.penerbit.add-edit', ['edit' => true, 'data'=> $penerbit]);
    }

    public function update(Request $request, $id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($request->all());
        return redirect('mdata/penerbit')
            ->withSuccess(__('Data Penerbit berhasil diubah.'));
    }

    public function delete(Request $request, $id)
    {
        $penerbit = Penerbit::findOrFail($id);
        Penerbit::destroy($id);
        return redirect('mdata/penerbit')
            ->withSuccess(__('Data Penerbit berhasil dihapus.'));
    }

    public function import() {
        Excel::import(new PenerbitsImport,request()->file('file'));
        return redirect('mdata/penerbit')
            ->withSuccess(__('Data Penerbit berhasil ditambahkan.'));
    }
}
