<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayarans;
use App\Models\Penjualans;
class PembayaransController extends Controller
{
    public function store(Request $request)
    {

        $simpan= Pembayarans::create($request->all());

        if($simpan){

            return response()->json(['text' => 'Data Berhasil disimpan'],200);
        }else{
            return response()->json(['text' => 'Data gagal disimpan'],422);
        }
    }
}
