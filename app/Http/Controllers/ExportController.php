<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayarans;
use App\Exports\ExportLaporan;
use App\Exports\ExportPembelian;
use App\Models\Penjualans;
use Excel;
class ExportController extends Controller
{
    public function laporan(Request $request)
    {
        return Excel::download(new ExportLaporan, 'laporanpenjualan.xlsx');
    }

    public function pembelian(Request $request)
    {
        return Excel::download(new ExportPembelian, 'laporanPembelian.xlsx');
    }
}
