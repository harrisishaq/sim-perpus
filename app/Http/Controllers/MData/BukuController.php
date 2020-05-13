<?php

namespace App\Http\Controllers\MData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MData\Buku;
use App\MData\Penerbit;
use DB;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$buku = Buku::all()->sortBy('kode_buku');
        $jumlah_buku = DB::table('bukus')->sum('stok_tersedia');
        $list_judul = Buku::all();
        $total_judul = $list_judul->count();
    	// dd(round($jumlah_buku));
    	return view('mdata.buku.index', ['data'=> $buku, 'jumlah_buku' => $jumlah_buku, 'jumlah_judul' => $total_judul]);
    }

    public function add()
    {
    	$penerbit = Penerbit::where('status', 1)->get();
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
