<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
class SuplierController extends Controller
{

    public function index()
    {
        $data =Suplier::all();
        if(request()->ajax()){
            return datatables()->of($data)
            ->addColumn('aksi', function($data)
            {

                $button = '<button class="edit btn btn-sm btn-warning" name="edit" id="'.$data->id .'">Edit</button>';
                $button .= '<button class="hapus btn btn-sm btn-danger" name="hapus" id="'.$data->id .'">Hapus</button>';

                    return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('admin.SupliersHome');
    }
    public function store(Request $request)
    {
        $rules =[
            'nama'=>'required',
            'telp' => 'required|min:8|unique:supliers,telp',
            'email' => 'required|unique:supliers,email',
            'rekening' => 'required|unique:supliers,rekening',
            'alamat' => 'required'
        ];
        $text=[
            'nama.required' => 'Kolom nama tidak boleh kosong',
            'telp.required' => 'Kolom telp tidak boleh kosong',
            'telp.unique' => 'Data Sudah ada',
            'email.required' => 'Kolom email tidak boleh kosong',
            'email.unique' => 'Data Sudah ada',
            'rekening.required' => 'Kolom rekening tidak boleh kosong',
            'rekening.unique' => 'Data Sudah ada',
            'alamat.required' => 'Kolom alamat tidak boleh kosong',

        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if($validasi->fails()){
            return response()->json(['success' =>0,'text' => $validasi->errors()->first()],422);
        }
        $simpan= Suplier::create($request->all());

        if($simpan){
            return response()->json(['text' => 'Data Berhasil disimpan'],200);
        }else{
            return response()->json(['text' => 'Data gagal disimpan'],422);
        }
    }
    public function edits(Request $request)
    {
        $data =Suplier::find($request->id);
        return response()->json($data);
    }

    public function updates(Request $request)
    {
        // dd($request->all());

        $data = Suplier::find($request->id);
        $data->update($request->all());

        if($data)
        {
            return response()->json(['text' => 'Data Berhasil disimpan'],200);
        }else{
            return response()->json(['text' => 'Data Gagal disimpan'],400);
        }
    }
    public function hapus(Request $request)
    {
        $data =Suplier::find($request->id);
        $simpan = $data->delete($request->all());

        if($simpan){
            return response()->json(['text' => 'Data Berhasil disimpan'],200);
        }else{
            return response()->json(['text' => 'Data gagal disimpan'],400);
        }
    }
}
