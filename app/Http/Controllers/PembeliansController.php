<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pembelians;
use App\Models\Suplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class PembeliansController extends Controller
{
    public function index()
    {
        $suppliers =Suplier::pluck('nama','id');
        $obats =Obat::select('id','kode')->get();
        $time = Carbon::now()->format('Y-m-d');
        $anytime =Carbon::now();
        $tanggal =$anytime->year . $anytime->month;
        $hitung =Pembelians::count();
        if($hitung == 0){
            $urut =100001;
            $nomor ='FKTR' . $tanggal . $urut;

        }else{
            $ambil = Pembelians::all()->last();
            $urut =(int) substr($ambil->faktur, -6) + 1;
            $nomor = 'FKTR' . $tanggal . $urut;
        }
        return view('admin.BelanjaHome', compact('time','nomor','suppliers','obats'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $diskon = ((int) $request->diskon /100) * $request->subtotal;
        $pajak =((int) $request->pajak/ 100) * $request->subtotal;
        $bersih = ((int)$request->subtotal + $pajak) - $diskon;
        $data =[
            'faktur' => $request->faktur,
            'item' => $request->item,
            'harga' => $request->harga,
            'qty' => $request->qty,
            'tanggal' =>$request->tanggal,
            'totalkotor' => $request->subtotal,
            'pajakBeli' =>$pajak,
            'diskonBeli' => $diskon,
            'totalbersih'=> $bersih,
            'keterangan' => $request->keterangan,
            'supplier' => $request->supplier,
            'admin' => Auth::user()->id
        ];
        $simpan = Pembelians::create($data);
        if($simpan){
            return response()->json(['text' => 'Data berhasil disimpan'], 200);
        }else{

            return response()->json(['text' => 'Data gagal disimpan'], 500);
        }
    }


    public function dataTable(Request $request)
    {
        $faktur = $request->faktur;
        $data =Pembelians::join()
                ->where('pembelians.faktur', $faktur)
                ->select( 'pembelians.*','supliers.nama as suplier')
                ->latest();
                if(request()->ajax()){
                    if(!empty($data)){

                    return datatables()->of($data)
                    ->addColumn('aksi', function($data){
                        $button ='<button class="hapus btn btn-sm btn-warning" id="'.$data->id.'" name="hapus">Hapus</button>';

                        return $button;
                    })
                    ->rawColumns(['aksi'])
                    ->make(true);
                        }
                    }
    }

    public function hapus(Request $request)
    {
        $id= $request->id;
        $data= Pembelians::find($id);
        $hapus =$data->delete();
        if($hapus){
            return response()->json(['text' => 'Data Berhasil dihapus'],200);
        }else{
            return response()->json(['text' => 'Data gagal dihapus'],500);
        }
    }

    public function bayar(Request $request)
    {
        $faktur =$request->id;
        $data =Pembelians::hitung($faktur)
                ->groupBy('faktur')
                ->get();
            return response()->json(['data' => $data],200);
    }
}
