<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class StokObat extends Model
{
    use HasFactory;
    protected $fillable =[
        'idObat',
        'masuk',
        'keluar',
        'jual',
        'beli',
        'stok',
        'keterangan',
        'admin'
    ];
    public static function join()
    {
        $data = DB::table('stok_obats')
                ->join('obats','obats.id','stok_obats.idObat')
                ->join('users','users.id','stok_obats.admins')
                ->select('stok_obats.*','obats.nama as namaObat','users.name as admins');
                
                return $data;
    }

}
