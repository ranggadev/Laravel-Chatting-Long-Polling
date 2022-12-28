<?php

namespace App\Exports;

use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PesananExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function __construct($from, $to, $omzetRentangUang, $profitRentangUang, $pesananRentang)
    {
        $this->from = $from;
        $this->to = $to;
        $this->omzetRentangUang = $omzetRentangUang;
        $this->profitRentangUang = $profitRentangUang;
        $this->pesananRentang = $pesananRentang;
    }

    public function view(): View
    {
        $data["from"]  = $this->from;
        $data["to"]  = $this->to;
        $data["omzet_rentang_uang"]  = $this->omzetRentangUang;
        $data["profit_rentang_uang"] = $this->profitRentangUang;
        $data["pesanan_rentang"]     = $this->pesananRentang;
        $data["laporans"] = Pesanan::select('no_antrian',
                                'status_pesanan',
                                'nama_pelanggan',
                                'subtotal',
                                'tax',
                                'grand_total',
                                'dibayar',
                                'kembalian',
                                'user_id',
                                'user_name',
                                'created_at'
                        )
                        ->whereDate('created_at', '>=', $this->from)->whereDate('created_at', '<=', $this->to)->get();

        return view('exports.laporan', $data);
    }
}
