<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\StokObat;
class Obat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'kode',
        'dosis',
        'indikasi',
        'alamat',
        'kategori',
        'satuan',
        'ready'
    ];


    public static function join()
    {
        $data = DB::table('obats')
                ->join('kategoris','obats.kategori','kategoris.id')
                ->join('satuans','obats.satuan','satuans.id')
                ->select('obats.*','satuans.satuan as satuans','kategoris.kategori as kategoris')
                ->get();

            return $data;
    }

    public static function joinstok()
    {
        $data =DB::table('stok_obats')
                ->join('obats','obats.id','stok_obats.idObat')
                ->select('stok_obats.*','obats.nama as namaObat','obats.id as idObat')
                ->get();

                return $data;
    }
}
