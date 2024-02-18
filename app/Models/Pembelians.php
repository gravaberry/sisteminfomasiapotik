<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Pembelians extends Model
{
    use HasFactory;
    protected $fillable =[
            'faktur',
            'harga',
            'item',
            'qty',
            'tanggal',
            'totalkotor' ,
            'pajakBeli',
            'diskonBeli',
            'totalbersih',
            'keterangan' ,
            'supplier' ,
            'admin' ,
    ];

    // public static function simpan($data)
    // {

    //     return Pembelians::create($datas);
    // }

    public static function join()
    {
        return $data = DB::table('pembelians')
                    ->join('supliers','supliers.id','=','pembelians.supplier')
                    ->join('users','users.id','=','pembelians.admin');
    }

    public static function hitung(string $id)
    {
        return $db =DB::table('pembelians')
                    ->where('faktur', $id)
                    ->selectRaw('SUM(totalkotor) as total_kotor')
                    ->selectRaw('SUM(pajakBeli) as pajak')
                    ->selectRaw('SUM(totalbersih) as total_bersih')
                    ->selectRaw('SUM(diskonBeli) as diskons');

    }
}
