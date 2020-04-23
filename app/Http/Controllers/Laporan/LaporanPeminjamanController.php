<?php

namespace App\Http\Controllers\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MData\Mahasiswa;
use App\MData\Buku;
use App\Operational\Transaksi;
use App\Operational\Denda;
use DateTime;
use PDF;

class LaporanPeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$transaksi = Transaksi::all()->sortBy('date_from');
    	return view('report.peminjaman.index', ['data' => $transaksi]);
    }

    public function report(Request $request)
    {
    	$choice = $request->radio;
    	$first = new DateTime('first day of January this year');
    	$last = new DateTime('last day of December this year');
    	$first = $first->format('Y-m-d');
    	$last = $last->format('Y-m-d');
        
        if($choice == "all"){

        	$data = Transaksi::where('date_from','>=', $first)->where('date_from', '<=', $last)->orderBy('id', 'desc')->get();
            
        	$pdf = PDF::loadview('report.peminjaman.export-all-pdf',[
                'report'=>$data,
                ])->setPaper([0,0, 612, 935.433], 'landscape');
            return $pdf->stream('All-Transaction.pdf');
        
        }
        elseif($choice == "nim")
        {
        	$mahasiswas_id = $request->mahasiswas_id;
        	
        	if($mahasiswas_id == null)
            {
            	return redirect('laporan/peminjaman')->withErrors(__('Gagal mengunduh laporan, pastikan anda telah mengisi NIM dari Mahasiswa yang diinginkan.'));
            } else {
            	$data = Transaksi::where('mahasiswas_id', $mahasiswas_id)->where('date_from','>=', $first)->where('date_from', '<=', $last)->orderBy('date_from', 'asc')->get();
            }

            $mahasiswaData = Mahasiswa::where('id', $mahasiswas_id)->first();

            $pdf = PDF::loadview('report.peminjaman.export-mahasiswa-pdf',[
                'report'=>$data,
                'mahasiswa' => $mahasiswaData,
                ])->setPaper([0,0, 612, 935.433], 'landscape');
            
            return $pdf->stream('Laporan Transaksi Peminjaman '.$mahasiswaData->nim.' (All-Transaction).pdf');

        }
        elseif($choice == "month")
        {
        	$selected_month = $request->month;
        	$first_day = new DateTime('first day of '.$selected_month.' this year');
        	$last_day = new DateTime('last day of '.$selected_month.' this year');
        	$first_day = $first_day->format('Y-m-d');
        	$last_day = $last_day->format('Y-m-d');
        	
        	dd($last_day);

        	if($date_from != null || $date_until != null)
            {
                $data = Transaksi::where('date_from','>=', $first_day)->where('date_from', '<=', $last_day)->orderBy('date_from', 'asc')->get();

                $pdf = PDF::loadview('report.peminjaman.export-date-pdf',[
                'report'=>$data,
                'date_from'=>$date_from,
                'date_until'=>$date_until,
                ])->setPaper([0,0, 612, 935.433], 'landscape');

                return $pdf->stream('Laporan Transaksi Peminjaman '.$date_from.' - '.$date_until.' (All-Transaction).pdf');

            } else {
            	return redirect('laporan/peminjaman')->withErrors(__('Gagal mengunduh laporan, pastikan anda telah mengisi rentang tanggalyang diinginkan dengan benar.'));
            }
        }
        elseif($choice == "specific")
        {
        	$date_from = $request->date_from;
            $date_until = $request->date_until;
            
            if($date_from != null || $date_until != null)
            {
                $data = Transaksi::where('date_from','>=', $date_from)->where('date_until', '<=', $date_until)->orderBy('date_from', 'asc')->get();

                $pdf = PDF::loadview('report.peminjaman.export-date-pdf',[
                'report'=>$data,
                'date_from'=>$date_from,
                'date_until'=>$date_until,
                ])->setPaper([0,0, 612, 935.433], 'landscape');

                return $pdf->stream('Laporan Transaksi Peminjaman '.$date_from.' - '.$date_until.' (All-Transaction).pdf');

            } else {
            	return redirect('laporan/peminjaman')->withErrors(__('Gagal mengunduh laporan, pastikan anda telah mengisi rentang tanggalyang diinginkan dengan benar.'));
            }
        }
    }
}
