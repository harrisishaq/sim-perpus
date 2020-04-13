<?php

namespace App\Http\Controllers\MData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MData\Buku;
use App\MData\Penerbit;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$buku = Buku::all()->sortBy('kode_buku');
    	// dd($buku);
    	return view('mdata.buku.index', ['data'=> $buku]);
    }

    public function add()
    {
    	$penerbit = Penerbit::all();
        return view('mdata.buku.add-edit', ['edit'=> false, 'penerbit' => $penerbit]);
    }

    public function create(Request $request)
    {
        $buku = Buku::create($request->all());
        return redirect('mdata/buku')
            ->withSuccess(__('Data Buku berhasil ditambahkan.'));
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $penerbit = Penerbit::all();
        return view('mdata.buku.add-edit', ['edit' => true, 'data'=> $buku, 'penerbit' => $penerbit]);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update($request->all());
        return redirect('mdata/buku')
            ->withSuccess(__('Data Buku berhasil diubah.'));
    }

    public function delete(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        Buku::destroy($id);
        return redirect('mdata/buku')
            ->withSuccess(__('Data Buku berhasil dihapus.'));
    }
}
