<?php

namespace App\Http\Controllers\Operational;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MData\Mahasiswa;
use App\MData\Buku;
use App\MData\Parameter;
use App\Operational\Transaksi;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$transaksi = Transaksi::all()->sortBy('date_from');
    	return view('operational.transaksi.index', ['data' => $transaksi]);
    }

    public function add()
    {
    	$buku = Buku::where('status', 1)->get();
    	return view('operational.transaksi.add-edit', ['edit' => false, 'buku' => $buku]);
    }

    public function getMahasiswaData(Request $request)
    {

        $dt = Mahasiswa::where('nim', $request->nim)->first();

        if (!empty($dt)) {
            $resp = [
                'code'=>200,
                'data' =>
                    [
                        'id'                => $dt->id,
                        'nama'              => $dt->nama,
                        'no_hp'   			=> $dt->no_hp
                    ]
                ];
            return json_encode($resp);
        } else {
            return json_encode(['code'=>404]);
        }
    }

    public function getMaxHariPinjam()
    {

        $dt = Parameter::where('id', 1)->first();

        if (!empty($dt)) {
            $resp = [
                'code'=>200,
                'data' =>
                    [
                        'hari_pinjam' => $dt->hari_pinjam,
                    ]
                ];
            return json_encode($resp);
        } else {
            return json_encode(['code'=>404]);
        }
    }

    public function create(Request $request)
    {
    	$data = $request->except(['_method', '_token']);
    	$data['status'] = "0";
        
        $transaksi = new Transaksi;
        $transaksi->mahasiswas_id = $data['mahasiswas_id'];
        $transaksi->bukus_id = $data['bukus_id'];
        $transaksi->date_from = $data['date_from'];
        $transaksi->date_until = $data['date_until'];
        $transaksi->status = $data['status'];

        $transaksi->save();

        $data_buku = Buku::findOrFail($data['bukus_id']);
        if($data_buku['stok_tersedia'] == ($data_buku['stok_terpinjam'] + 1))
        {
        	Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] + 1, 'status' => "0"));
        } 
        else
        {
        	Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] + 1));
        }
        return redirect('operational/transaksi')
            ->withSuccess(__('Data Peminjaman Buku berhasil ditambahkan.'));
    }

    public function edit($id)
    {
        $data = Transaksi::findOrFail($id);
        $mahasiswa = Mahasiswa::findOrFail($data->mahasiswas_id);
        $buku = Buku::where('status', 1)->get();
        return view('operational.transaksi.add-edit', ['edit' => true, 'buku'=> $buku, 'data' => $data, 'mahasiswa' => $mahasiswa]);
    }

    public function update(Request $request, $id)
    {
    	$old_data = Transaksi::findOrFail($id);
        $data = $request->except(['_method', '_token']);

    	if ($old_data['bukus_id'] != $data['bukus_id'])
    	{
    		$data_buku_old = Buku::findOrFail($old_data['bukus_id']);
	        if($data_buku_old['stok_tersedia'] == ($data_buku_old['stok_terpinjam']))
	        {
	        	Buku::where('id', $data_buku_old['id'])->update(array('stok_terpinjam' => $data_buku_old['stok_terpinjam'] - 1, 'status' => "1"));
	        } 
	        else
	        {
	        	Buku::where('id', $data_buku_old['id'])->update(array('stok_terpinjam' => $data_buku_old['stok_terpinjam'] - 1));
	        }

	        $data_buku = Buku::findOrFail($data['bukus_id']);
	        if($data_buku['stok_tersedia'] == ($data_buku['stok_terpinjam'] + 1))
	        {
	        	Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] + 1, 'status' => "0"));
	        } 
	        else
	        {
	        	Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] + 1));
	        }

	        Transaksi::where('id', $id)->update(array('mahasiswas_id' => $data['mahasiswas_id'], 'bukus_id' => $data['bukus_id'], 'date_from' => $data['date_from'], 'date_until' => $data['date_until']));
    	}
    	else
    	{
    		Transaksi::where('id', $id)->update(array('mahasiswas_id' => $data['mahasiswas_id'], 'date_from' => $data['date_from'], 'date_until' => $data['date_until']));
    	}

        return redirect('operational/transaksi')
            ->withSuccess(__('Data Peminjaman berhasil diubah.'));
    }

    public function delete($id)
    {
        $data = Transaksi::findOrFail($id);
        $data_buku = Buku::findOrFail($data['bukus_id']);
        if($data_buku['stok_tersedia'] == ($data_buku['stok_terpinjam']))
        {
        	Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1, 'status' => "1"));
        } 
        else
        {
        	Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1));
        }

        Transaksi::destroy($id);
        return redirect('operational/transaksi')
            ->withSuccess(__('Data Peminjaman berhasil dihapus.'));
    }
}
