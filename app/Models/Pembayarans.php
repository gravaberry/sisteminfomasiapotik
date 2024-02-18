<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pembayarans extends Model
{
    use HasFactory;
    protected $fillable =[
        'nota',
        'total',
        'diskon',
        'dibayar',
        'statusbayar'
    ];

    public static function joinbeli()
    {
        return $data =DB::table('pembayarans')
                ->join('pembelians','pembayarans.nota','=','pembelians.faktur')
                ->join('supliers','pembelians.supplier','=','supliers.id')
                ->join('users','pembelians.admin','=','users.id')
                ->select('pembayarans.*','supliers.nama as supplier','users.name');
    }


    public static function joinjual()
    {
         return $data= DB::table('pembayarans')
                    ->join('penjualans','pembayarans.nota','=','penjualans.nota')
                    ->join('obats','obats.id','=','penjualans.item')
                    ->join('pasiens','pasiens.id','=','penjualans.consumer')
                    ->join('stok_obats','stok_obats.idObat','=','obats.id')
                    ->join('users','users.id','=','penjualans.kasir')
                    ->select(
                        'penjualans.id as idPenjualan',
                        'penjualans.qty as Qty',
                        'penjualans.subtotal as subtotal',
                        'obats.nama as namaObat',
                        'obats.satuan',
                        'stok_obats.jual',
                        'pasiens.nama as customer',
                        'pasiens.alamat',
                        'pasiens.telp',
                        'users.name',
                        'pembayarans.*',

                    );


    }
}
