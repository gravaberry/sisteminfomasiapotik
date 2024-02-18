<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Satuan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
class ObatController extends Controller
{
    public function index()
    {
        $satuans = Satuan::select('id','satuan')->get();
        $kategoris = Kategori::select('id','kategori')->get();

        $data= Obat::join();
        if(request()->ajax()){
            return datatables()->of($data)
                ->addColumn('aksi', function($data){
                    $button ='<button class="edit btn btn-sm btn-primary" id="'.$data->id.'" name="edit">Edit</button>';
                    $button .='<button class="hapus btn btn-sm btn-danger" id="'.$data->id.'" name="hapus">hapus</button>';

                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.obatHome',compact('satuans','kategoris'));
    }
    public function store(Request $request)
    {
        $rules =[
            'nama' => 'required',
            'kode' =>'required|min:5|unique:obats,kode',
            'dosis' => 'required',
            'indikasi'=>'required',
            'alamat'=>'required',
            'kategori'=>'required',
            'satuan'=>'required',
            'ready'=>'required'
        ];
        $text=[
            'nama.required' => 'Kolom nama tidak boleh kosong',
            'kode.required' =>'Kolom nama tidak boleh kosong',
            'kode.unique' =>'kode sudah ada',
            'dosis.required' => 'Kolom nama tidak boleh kosong',
            'indikasi.required'=>'Kolom nama tidak boleh kosong',
            'alamat.required'=>'Kolom nama tidak boleh kosong',
            'ready.required'=>'Kolom nama tidak boleh kosong'
        ];
        $validasi =Validator::make($request->all(), $rules, $text);

        if($validasi->fails()){
            return response()->json(['success' =>0,$validasi->errors()->first()],422);
        }
        $simpan =Obat::create($request->all());

        if($simpan){
            return response()->json(['success' => 'Data Berhasil disimpan'],200);
        }else{
            return response()->json(['Gagal' => 'Data gagal disimpan'],422);
        }
    }
    public function edits(Request $request)
    {
        $data = Obat::find($request->id);
        return response()->json($data);
    }
    public function updates(Request $request)
    {
        $data =Obat::find($request->id);
        $data->update($request->all());
        if($data){
            return response()->json(['success' => 'Data Berhasil diUpdate'],200);
        }else{
            return response()->json(['Gagal' => 'Data gagal diUpdate'],422);
        }

    }
    public function hapus(Request $request)
    {
        $data =Obat::find($request->id);
        $simpan = $data->delete($request->all());
        if($data){
            return response()->json(['success' => 'Data Berhasil Dihapus'],200);
        }else{
            return response()->json(['Gagal' => 'Data gagal Dihapus'],422);
        }
    }

    public function getkode(Request $request)
    {
        $kode = $request->kode;
        $data =Obat::where('id',$kode)->get();

        return response()->json($data,200);
    }
}
