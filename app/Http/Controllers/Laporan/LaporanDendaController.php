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
use DB;

class LaporanDendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$denda = Denda::all();
    	// $transaksi = DB::table('transaksis')
     //    	->join('mahasiswas','transaksis.mahasiswas_id','=','mahasiswas.id')
     //    	->join('bukus','transaksis.bukus_id','=','bukus.id')
     //    	->join('dendas','transaksis.id','=','dendas.transaksis_id')
     //    	->select('transaksis.*', 'mahasiswas.nama', 'mahasiswas.nim', 'bukus.nama_buku', 'dendas.status')
     //    	->get();
        // dd($transaksi);
    	return view('report.denda.index', ['data' => $denda]);
    }

    public function report(Request $request)
    {
    	$choice = $request->radio;
    	$first = new DateTime('first day of January this year');
    	$last = new DateTime('last day of December this year');
    	$first = $first->format('Y-m-d');
    	$last = $last->format('Y-m-d');
        
        if($choice == "all"){
        	$data = Denda::with('transaksiInformation')->orderBy('transaksis_id', 'desc')->get();
        
        	// $data = Transaksi::where('date_returned','>=', $first)->where('date_returned', '<=', $last)->orderBy('date_returned', 'asc')->get();

        	// $data = DB::table('transaksis')
        	// ->join('dendas','dendas.transaksis_id','=','transaksis.id')
        	// ->join('mahasiswas','mahasiswas.id','=','transaksis.mahasiswas_id')
        	// ->join('bukus','bukus.id','=','transaksis.bukus_id')
        	// ->select('transaksis.date_returned', 'transaksis.id', 'mahasiswas.nama', 'mahasiswas.nim', 'bukus.nama_buku', 'dendas.status')
        	// ->where('transaksis.status', '1')
        	// ->get();

        	// dd($data);
            
        	$pdf = PDF::loadview('report.denda.export-all-pdf',[
                'report'=>$data,
                'date_from'=>$first,
                'date_until'=>$last,
                ])->setPaper([0,0, 612, 935.433], 'landscape');
            return $pdf->stream('All-Denda-Record.pdf');
        
        }
        elseif($choice == "nim")
        {
        	$mahasiswas_id = $request->mahasiswas_id;
        	
        	if($mahasiswas_id == null)
            {
            	return redirect('laporan/denda')->withErrors(__('Gagal mengunduh laporan, pastikan anda telah mengisi NIM dari Mahasiswa yang diinginkan.'));
            } else {
            	$data = Denda::with('transaksiInformation')->orderBy('transaksis_id', 'desc')->get();
            }

            $mahasiswaData = Mahasiswa::where('id', $mahasiswas_id)->first();

            $pdf = PDF::loadview('report.denda.export-mahasiswa-pdf',[
                'report'=>$data,
                'date_from'=>$first,
                'date_until'=>$last,
                'mahasiswa' => $mahasiswaData,
                ])->setPaper([0,0, 612, 935.433], 'landscape');
            
            return $pdf->stream('Laporan Transaksi Pengembalian '.$mahasiswaData->nim.' (All-Returned-Transaction).pdf');

        }
        elseif($choice == "month")
        {
        	$selected_month = $request->month;
        	$first_day = new DateTime('first day of '.$selected_month.' this year');
        	$last_day = new DateTime('last day of '.$selected_month.' this year');
        	$first_day = $first_day->format('Y-m-d');
        	$last_day = $last_day->format('Y-m-d');
        	
        	$data = Denda::with('transaksiInformation')->orderBy('transaksis_id', 'desc')->get();

                $pdf = PDF::loadview('report.denda.export-month-pdf',[
                'report'=>$data,
                'date_from'=>$first_day,
                'date_until'=>$last_day,
                ])->setPaper([0,0, 612, 935.433], 'landscape');

                return $pdf->stream('Laporan Transaksi Peminjaman '.$first_day.' - '.$last_day.' (All-Returned-Transaction).pdf');

        }
        elseif($choice == "specific")
        {
        	$date_from = $request->date_from;
            $date_until = $request->date_until;
            
            if($date_from != null || $date_until != null)
            {
                $data = Denda::with('transaksiInformation')->orderBy('transaksis_id', 'desc')->get();

                $pdf = PDF::loadview('report.denda.export-date-pdf',[
                'report'=>$data,
                'date_from'=>$date_from,
                'date_until'=>$date_until,
                ])->setPaper([0,0, 612, 935.433], 'landscape');

                return $pdf->stream('Laporan Transaksi Pengembalian '.$date_from.' - '.$date_until.' (All-Returned-Transaction).pdf');

            } else {
            	return redirect('laporan/denda')->withErrors(__('Gagal mengunduh laporan, pastikan anda telah mengisi rentang tanggal yang diinginkan dengan benar.'));
            }
        }
    }
}
