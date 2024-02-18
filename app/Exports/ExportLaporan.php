<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Pembayarans;
use App\Models\Penjualans;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportLaporan implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // public function __construct(array $data)
    // {
    //     $this->min =$data['minp'];
    //     $this->max =$data['maxp'];
    // }
    public function headings():array
    {
        return [
            'NO',
            'NOTA',
            'TANGGAL',
            'qty',
            'DISKON',
            'SUBTOTAL',
            'NAMA OBAT',
            'CUSTOMER',
            'KASIR'
        ];
    }
    public function collection()
    {
        // $data =Penjualans::all();
        $data =Penjualans::join()->get();

        $xport[]=[
            'NO',
            'NOTA',
            'TANGGAL',
            'qty',
            'DISKON',
            'SUBTOTAL',
            'NAMA OBAT',
            'CUSTOMER',
            'KASIR'
        ];

        $no =1;
        foreach ($data as $key){
            $export []=[
                'NO' => $no,
                'NOTA'=> $key->nota,
                'TANGGAL' => $key->tanggal,
                'qty'=> $key->qty,
                'DISKON'=> $key->diskon,
                'SUBTOTAL'=> $key->subtotal,
                'NAMA OBAT'=> $key->namaObat,
                'CUSTOMER'=> $key->customer,
                'KASIR'=> $key->name,
            ];
            $no ++;
        }

        return collect($export);
    }
}
