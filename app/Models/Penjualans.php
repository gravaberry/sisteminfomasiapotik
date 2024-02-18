<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Penjualans extends Model
{
    use HasFactory;
    protected $fillable =[
        'nota',
        'tanggal',
        'qty',
        'diskon',
        'subtotal',
        'item',
        'consumer',
        'kasir'
    ];

    public static function join()
    {
          $data= DB::table('penjualans')
                    ->join('obats','obats.id','=','penjualans.item')
                    ->join('pasiens','pasiens.id','=','penjualans.consumer')
                    ->join('stok_obats','stok_obats.idObat','=','obats.id')
                    ->join('users','users.id','=','penjualans.kasir')
                    ->select(
                        'penjualans.*',
                        'obats.nama as namaObat',
                        'users.name',
                        'stok_obats.jual',
                        'pasiens.nama as customer'
                    );
                    return $data;

    }

    public static function hitung($id)
    {
        $data =DB::table('penjualans')->where('nota', $id)
                ->selectRaw('SUM(subtotal) as totalHarga')
                ->selectRaw('nota')
                ->groupBy('nota')
                ->get();

        return $data;
    }

    public static function joincetak()
    {
         return $data= DB::table('penjualans')
                    ->join('obats','obats.id','=','penjualans.item')
                    ->join('pasiens','pasiens.id','=','penjualans.consumer')
                    ->join('stok_obats','stok_obats.idObat','=','obats.id')
                    ->join('users','users.id','=','penjualans.kasir')
                    ->join('pembayarans','pembayarans.nota','=','penjualans.nota')
                    ->select(
                        'penjualans.*',
                        'obats.nama as namaObat',
                        'obats.kode',
                        'obats.indikasi',
                        'obats.dosis',
                        'obats.satuan',
                        'stok_obats.jual',
                        'pasiens.nama as customer',
                        'pasiens.alamat',
                        'pasiens.telp',
                        'users.name',
                        'pembayarans.total',
                        'pembayarans.diskon',
                        'pembayarans.dibayar',

                    );


    }
}
