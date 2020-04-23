<?php

namespace App\Http\Controllers\Operational;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Operational\Denda;
use App\Operational\Transaksi;
use App\MData\Mahasiswa;
use App\MData\Buku;


class DendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$denda = Denda::where('status', 1)->get();
    	return view('operational.denda.index', ['data' => $denda]);
    }

    public function showAll()
    {
    	$denda = Denda::all();
    	return view('operational.denda.index', ['data' => $denda]);
    }

    public function edit($id)
    {
        $denda = Denda::where('id', $id)->first();
        $data = Transaksi::where('id', $denda->transaksis_id)->first();
        $mahasiswa = Mahasiswa::findOrFail($data->mahasiswas_id);
        $buku = Buku::where('status', 1)->get();
        return view('operational.denda.bayar-denda', ['edit' => true, 'buku'=> $buku, 'data' => $data, 'mahasiswa' => $mahasiswa]);
    }

    public function update(Request $request, $id)
    {
    	Denda::where('transaksis_id', $id)->update(array('date_paid' => $request->date_paid, 'status' => 0));

        return redirect('operational/denda')
            ->withSuccess(__('Data Denda berhasil diubah.'));
    }
}
