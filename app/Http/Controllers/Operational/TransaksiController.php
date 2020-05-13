<?php

namespace App\Http\Controllers\Operational;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MData\Mahasiswa;
use App\MData\Buku;
use App\MData\Parameter;
use App\Operational\Transaksi;
use App\Operational\Denda;
use DateTime;

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
                        'no_hp'   			=> $dt->no_hp,
                        'email'             => $dt->email
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
        $transaksi->description = $data['description'];

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

        if ($data->status == 1) {
            return redirect('operational/transaksi')
            ->withErrors(__('Data Peminjaman Buku yang sudah dikembalikan tidak dapat diubah.'));
        }
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

	        Transaksi::where('id', $id)->update(array('mahasiswas_id' => $data['mahasiswas_id'], 'bukus_id' => $data['bukus_id'], 'date_from' => $data['date_from'], 'date_until' => $data['date_until'], 'description' => $data['description']));
    	}
    	else
    	{
    		Transaksi::where('id', $id)->update(array('mahasiswas_id' => $data['mahasiswas_id'], 'date_from' => $data['date_from'], 'date_until' => $data['date_until'], 'description' => $data['description']));
    	}

        return redirect('operational/transaksi')
            ->withSuccess(__('Data Peminjaman berhasil diubah.'));
    }

    public function delete($id)
    {
        $data = Transaksi::findOrFail($id);
        $data_buku = Buku::findOrFail($data['bukus_id']);

        if ($data['status'] == 0) {
            if($data_buku['stok_tersedia'] == ($data_buku['stok_terpinjam']))
            {
            	Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1, 'status' => "1"));
            } 
            else
            {
            	Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1));
            }
        }

        Transaksi::destroy($id);
        return redirect('operational/transaksi')
            ->withSuccess(__('Data Peminjaman berhasil dihapus.'));
    }

    public function kembali($id)
    {
        $data = Transaksi::findOrFail($id);
        $denda = Denda::where('transaksis_id', $id)->where('status', 0)->get();
        // dd($denda->status);
        if (empty($denda)) {
            return redirect('operational/transaksi')
            ->withErrors(__('Data Peminjaman Buku yang sudah dibayar tidak dapat diubah.'));
        }
        $mahasiswa = Mahasiswa::findOrFail($data->mahasiswas_id);
        $buku = Buku::where('status', 1)->get();
        return view('operational.transaksi.kembali', ['edit' => true, 'buku'=> $buku, 'data' => $data, 'mahasiswa' => $mahasiswa]);
    }

    public function showListPinjam()
    {
        $transaksi = Transaksi::all()->sortBy('date_from');
        return view('operational.transaksi.index-pinjam', ['data' => $transaksi]);
    }

    public function addKembali(Request $request, $id)
    {
        $data = Transaksi::findOrFail($id);
        $data_buku = Buku::findOrFail($data['bukus_id']);
        $isLate = 0;
        $param = Parameter::where('id', 1)->first();
        $date1 = new DateTime($data['date_until']);
        $date2 = new DateTime($request->date_returned);
        $interval = $date2->diff($date1);
        $days = $interval->format('%a');
        # Memeriksa status buku sudah kembali atau belum, jika belum:
        if ($data['status'] == 0) {
            //Memeriksa apakah tanggal pengembalian masih sebelum tanggal batas pengembalian
            if ($data['date_until'] <= $request->date_returned) {
                #Menyimpan data denda
                $denda = new Denda;

                $denda->transaksis_id = $id;
                $denda->hari_telat = $days;
                $denda->denda = $param->denda * $days;
                $denda->status = 1;
                
                $denda->save();

                $isLate = 1;
            }

            #Memperbarui data transaksi (menambah tanggal pengembalian)
            Transaksi::where('id', $id)->update(array('date_returned' => $request->date_returned, 'status' => 1));

            #Memeriksa apakah stok buku yang semula habis atau tidak
            if($data_buku['stok_tersedia'] == $data_buku['stok_terpinjam'])
            {
                Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1, 'status' => "1"));
            } else {
                Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1));
            }

            if ($isLate) {
                return redirect('operational/denda')
                ->withSuccess(__('Data Pengembalian berhasil ditambahkan, pengembalian melewati batas peminjaman, denda telah ditambahkan.'));
            } else {
                return redirect('operational/transaksi')
                ->withSuccess(__('Data Pengembalian berhasil ditambahkan.'));
            }
        } else {
            $data_denda = Denda::where('transaksis_id', $id)->first();

            // dd($data_denda);
            if (empty($data_denda)){
                // dd("Tidak ada");
                //Memeriksa apakah tanggal pengembalian masih sebelum tanggal batas pengembalian
                if ($data['date_until'] <= $request->date_returned) {
                    #Menyimpan data denda
                    $denda = new Denda;

                    $denda->transaksis_id = $id;
                    $denda->hari_telat = $days;
                    $denda->denda = $param->denda * $days;
                    $denda->status = 1;
                    
                    $denda->save();

                    $isLate = 1;
                }

                #Memperbarui data transaksi (menambah tanggal pengembalian)
                Transaksi::where('id', $id)->update(array('date_returned' => $request->date_returned));

                if ($isLate) {
                    return redirect('operational/denda')
                    ->withSuccess(__('Data Pengembalian berhasil diubah, pengembalian melewati batas peminjaman, denda telah diperbarui.'));
                } else {
                    return redirect('operational/transaksi')
                        ->withSuccess(__('Data Pengembalian berhasil diperbarui.'));
                }
            } else {
                // dd("Ada");

                if ($data['date_until'] >= $request->date_returned) {
                    Denda::destroy($data_denda['id']);

                    Transaksi::where('id', $id)->update(array('date_returned' => $request->date_returned));

                    return redirect('operational/transaksi')
                        ->withSuccess(__('Data Pengembalian berhasil diperbarui.'));
                } else {
                    $biaya_denda_hari = $data_denda['denda'] / $data_denda['hari_telat'];

                    Denda::where('id', $data_denda['id'])->update(array('denda' => $biaya_denda_hari * $days, 'hari_telat' => $days));

                    Transaksi::where('id', $id)->update(array('date_returned' => $request->date_returned));

                    return redirect('operational/denda')
                    ->withSuccess(__('Data Pengembalian berhasil diubah, pengembalian melewati batas peminjaman, denda telah diperbarui.'));
                }
            }
        }
    }

    // public function addKembali2(Request $request, $id)
    // {
    //     $data = Transaksi::findOrFail($id);
    //     $data_buku = Buku::findOrFail($data['bukus_id']);
    //     $isLate = 0;
    //     $param = Parameter::where('id', 1)->first();
    //     $date1 = new DateTime($data['date_until']);
    //     $date2 = new DateTime($request->date_returned);
    //     $interval = $date2->diff($date1);
    //     $days = $interval->format('%a');

    //     if ($data['status'] == 0) {
    //         //Memeriksa apakah tanggal pengembalian masih sebelum tanggal batas pengembalian
    //         if ($data['date_until'] <= $request->date_returned) {
    //             #Menyimpan data denda
    //             $denda = new Denda;

    //             $denda->transaksis_id = $id;
    //             $denda->hari_telat = $days;
    //             $denda->denda = $param->denda * $days;
    //             $denda->status = 1;
                
    //             $denda->save();

    //             $isLate = 1;
    //         }

    //         #Memperbarui data transaksi (menambah tanggal pengembalian)
    //         Transaksi::where('id', $id)->update(array('date_returned' => $request->date_returned, 'status' => 1));

    //         #Memeriksa apakah stok buku yang semula habis atau tidak
    //         if($data_buku['stok_tersedia'] == $data_buku['stok_terpinjam'])
    //         {
    //             Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1, 'status' => "1"));
    //         } else {
    //             Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1));
    //         }

    //         if ($isLate) {
    //             return redirect('operational/denda')
    //             ->withSuccess(__('Data Pengembalian berhasil ditambahkan, pengembalian melewati batas peminjaman, denda telah ditambahkan.'));
    //         } else {
    //             return redirect('operational/transaksi')
    //                 ->withSuccess(__('Data Pengembalian berhasil ditambahkan.'));
    //         }

    //     } else {
    //         $data_denda = Denda::where('transaksis_id', $id)->get();
    //         # Memeriksa apakah sebelumnya sudah ada data denda atau belum, jika belum ada
    //         if (!empty($data_denda)) {
    //             //Memeriksa apakah tanggal pengembalian sebelum tanggal batas pengembalian, jika tidak maka akan membuat data denda
    //             if ($data['date_until'] <= $request->date_returned) {
    //                 #Menyimpan data denda
    //                 $denda = new Denda;

    //                 $denda->transaksis_id = $id;
    //                 $denda->hari_telat = $days;
    //                 $denda->denda = $param->denda * $days;
    //                 $denda->status = 1;
                    
    //                 $denda->save();

    //                 $isLate = 1;
    //             }

    //             #Memperbarui data transaksi (menambah tanggal pengembalian)
    //             Transaksi::where('id', $id)->update(array('date_returned' => $request->date_returned, "status" => 1));

    //             #Memeriksa apakah stok buku yang semula habis atau tidak
    //             if($data_buku['stok_tersedia'] == $data_buku['stok_terpinjam'])
    //             {
    //                 Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1, 'status' => "1"));
    //             } else {
    //                 Buku::where('id', $data_buku['id'])->update(array('stok_terpinjam' => $data_buku['stok_terpinjam'] - 1));
    //             }

    //             # Memeriksa apakah pengembalian terlambat
    //             if ($isLate) {
    //                 return redirect('operational/denda')
    //                 ->withSuccess(__('Data Pengembalian berhasil diubah, pengembalian melewati batas peminjaman, denda telah diperbarui.'));
    //             } else {
    //                 return redirect('operational/transaksi')
    //                     ->withSuccess(__('Data Pengembalian berhasil diperbarui.'));
    //             }
    //         } else {
    //             if ($data_denda['status'] == 0){
    //                 return redirect('operational/transaksi')
    //                 ->withErrors(__('Data Peminjaman Buku yang sudah dikembalikan tidak dapat diubah.')); 
    //             } else {
    //                 $biaya_denda_hari = $data_denda['denda'] / $data_denda['hari_telat'];

    //                 Denda::where('id', $data_denda['id'])->update(array('hari_telat' => $days, 'denda' => $biaya_denda_hari * $days));

    //                 return redirect('operational/denda')
    //                 ->withSuccess(__('Data Pengembalian berhasil diubah, pengembalian melewati batas peminjaman, denda telah diperbarui.'));
    //             }
    //         }  
    //     }
    // }
}
