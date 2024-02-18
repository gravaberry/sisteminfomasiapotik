<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\StokObat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class StokObatController extends Controller
{
    public function index()
    {
        $obat =Obat::where('ready','N')->get();
        $data=StokObat::join()->get();
        if(request()->ajax()){
            return datatables()->of($data)
                ->addColumn('aksi', function($data){
                    $button ='<button class="edit btn btn-sm btn-primary" id="'.$data->id.'" name="edit">Edit</button>';
                    $button .='<button class="hapus btn btn-sm btn-danger" id="'.$data->id.'" name="hapus">hapus</button>';

                    return $button;
                })
                ->rawcolumns(['aksi'])
                ->make(true);
            }
        return view('admin.stokObatHome',compact('obat'));
    }

    public function store(Request $request)
    {
        // $rules =[
        //     'obat' => 'required',
        //     'masuk' =>'required',
        //     'keluar' =>'required',
        //     'jual' =>'required',
        //     'beli' =>'required',
        //     'expired' =>'required',
        //     'stok' =>'required',
        //     'keterangan' =>'required',

        // ];
        // $text=[
        //     'obat.required' => 'Kolom obat masih kosong',
        //     'masuk.required' =>'Kolom masuk masih kosong',
        //     'keluar.required' =>'Kolom keluar masih kosong',
        //     'jual.required' =>'Kolom jual masih kosong',
        //     'beli.required' =>'Kolom beli masih kosong',
        //     'expired.required' =>'Kolom expired masih kosong',
        //     'stok.required' =>'Kolom stok masih kosong',
        //     'keterangan.required' =>'Kolom keterangan masih kosong',
        // ];

        // $validasi = Validator::make($rules,$text);
        // if($validasi->fails()){
        //     return response()->json(['success' =>0, $validasi->errors()->first()],422);
        // }
        $data =new StokObat();
        $data->idObat = $request->obat;
        $data->masuk = $request->masuk;
        $data->keluar = $request->keluar;
        $data->jual = $request->jual;
        $data->beli = $request->beli;
        $data->expired = $request->expired;
        $data->stok = $request->stok;
        $data->keterangan = $request->keterangan;
        $data->admins = Auth::user()->id;

        $simpan =$data->save();
        if($simpan){
            DB::table('obats')->where('id', $request->obat)->update(['ready' => 'Y']);
            return response()->json(['text' => ' Stok Obat Berhasil disimpan'],200);
        }else{
            return response()->json(['text' => 'stok obat gagal disimpan'],422);
        }


    }
    public function getObat(Request $request)
    {
        $data =StokObat::where('idObat',$request->id)->first();
        $null =[
            'stok' => 0
        ];
        if($data !=null){
            return response()->json(['data' => $data]);
        }else{
            return response()->json(['data' => $null]);
        }


    }

    public function edits(Request $request)
    {
        $id = $request->id;
        $data = StokObat::join()
                ->where('stok_obats.id', $id)
                ->first();

        return response()->json($data);
    }

    public function updates(Request $request)
    {
        $datas =[
        'idObat' => $request->obat,
        'masuk' => $request->masuk,
        'keluar' => $request->keluar,
        'jual' => $request->jual,
        'beli' => $request->beli,
        'expired' => $request->expired,
        'stok' => $request->stok,
        'keterangan' => $request->keterangan,
        'admins' => Auth::user()->id
        ];

        $data= StokObat::find($request->id);
        $simpan= $data->update($datas);

        if($simpan){
            return response()->json(['success'=> 'Data Berhasil diupdate'],200);
        }else{
            return response()->json(['gaga' => 'Data gagal diUdpate'],422);
        }
    }
    public function hapus(Request $request)
    {
        $data =StokObat::find($request->id);
        $simpan =$data->delete($request->all());
        if($simpan){
            return response()->json(['success'=> 'Data Berhasil diupdate'],200);
        }else{
            return response()->json(['gaga' => 'Data gagal diUdpate'],422);
        }
    }
    private function data( array $data)
    {
        $data =[
            'idObat' => $data['obat'],
            'masuk' => $data['masuk'],
            'keluar' => $data['keluar'],
            'jual' => $data['jual'],
            'beli' => $data['beli'],
            'expired' => $data['expired'],
            'stok' => $data['stok'],
            'keterangan' => $data['keterangan'],
            'admins' => Auth::user()->id
            ];
        return $data;
    }

    public function getdataObat(Request $request)
    {
        $data =StokObat::find($request->id);

        return response()->json($data);
    }



}
