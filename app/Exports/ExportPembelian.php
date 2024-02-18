<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Pembelians;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportPembelian implements FromCollection,WithHeadings
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
    }
    public function collection()
    {
        // $data =Penjualans::all();
        $data =Pembelians::join()->get();

        $xport[]=[
            'NO',
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

        $no =1;
        foreach ($data as $key){
            $export []=[
                'NO' => $no,
                'faktur'=>$key->faktur,
                'harga' =>$key->harga,
                'item' =>$key->item,
                'qty' =>$key->qty,
                'tanggal' =>$key->tanggal,
                'totalkotor' =>$key->totalkotor ,
                'pajakBeli' =>$key->pajakBeli,
                'diskonBeli' =>$key->diskonBeli,
                'totalbersih' =>$key->totalbersih,
                'keterangan' =>$key->keterangan,
                'supplier' =>$key->nama,
                'admin' =>$key->name,
            ];
            $no ++;
        }

        return collect($export);
    }
}

