<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Penjualans;
use App\Models\StokObat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Facades\DB;
class PenjualansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obat=Obat::joinstok();
        $tanggals= Carbon::now()->format('Y-m-d');
        $now= Carbon::now();
        $tahunbulan= $now->year . $now->month;
        $cek =Penjualans::count();
        if($cek == 0){
            $urut= 10000001;
            $nomors = 'NT' . $tahunbulan . $urut;
        }else{
            $ambil =Penjualans::all()->last();
            $urut=(int)substr($ambil->nota, -8) + 1;
            if((int) substr($ambil->nota, -8) == 99999999){
                $urut =10000001;
            }
            $nomors ='NT' . $tahunbulan .$urut;
        }

        return view('admin.penjualanHome',compact('obat','tanggals','nomors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[

            'nama' =>'required',
            'telp' => 'required',
            'alamat' => 'required',
            'obat' => 'required',
            'qty' => 'required',
            ];

            $text=[
                'nama.required' =>'kolom nama tidak boleh kosong',
                'telp.required' => 'kolom telpon tidak boleh kosong',
                'alamat.required' => 'kolom alamat tidak boleh kosong',
                'obat.required' => 'kolom obat tidak boleh kosong',
                'qty.required' => 'kolom qantity tidak boleh kosong',
            ];

            $validasi= Validator::make($request->all(), $rules, $text);

            if($validasi->fails()){
                return response()->json(['success' => 0, $validasi->errors()->first()],422);
            }

            $pasien =[
                'nama' => $request->nama,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'resep' => $request->resep,
                'pengirim' => $request->pengirim
            ];
            $consumen = Pasien::create($pasien);
            $idPasien = $consumen->id;

            $penjualan =[
                'nota' => $request->no,
                'tanggal' => $request->tanggal,
                'qty' => $request->qty,
                'diskon' => $request->diskon,
                'subtotal' => $request->total,
                'item' => $request->obat,
                'consumer' => $idPasien,
                'kasir' => Auth::user()->id
            ];

            $transaksi =Penjualans::create($penjualan);
            if($transaksi){

                $stok =StokObat::where('idObat', $request->obat)->first();
                $stok->update(['stok' => $request->stoks]);
                return response()->json(['text' => 'Pembelian berhasil ditambah'],200);
            }else{
                return response()->json(['text' => 'Pembelian gagal ditambah'],422);
            }
    }
    public function dataTable(Request $request)
    {
        $nota = $request->id;
        $data =Penjualans::join()
                ->where('penjualans.nota', $nota)
                ->latest();
                if(request()->ajax()){
                    return datatables()->of($data)
                        ->addColumn('aksi', function($data){
                            $button ='<button class="hapus btn btn-sm btn-warning" id="'.$data->id.'" name="hapus">Hapus</button>';

                            return $button;
                        })
                        ->rawColumns(['aksi'])
                        ->make(true);
                    }
    }

    public function hapusOrder(Request $request)
    {
        $id = $request->id;
        $hapusJual = Penjualans::find($id);
        $stok = StokObat::where('idObat', $hapusJual->item)->first();
        $tambah = $hapusJual->qty + $stok->stok;
        $stok->update(['stok'=> $tambah]);

        if($stok){
            $hapus = $hapusJual->delete();
            return response()->json(['text', 'Data berhasil diKurangi'],200);
        }else{
            return response()->json(['text','Sistem Error'],500);
        }
    }

    public function hitung(Request $request)
    {
        $id=$request->id;
        $data = Penjualans::hitung($id);
        $datas =Penjualans::where('nota', $id)->get();
        $discount=[];
        foreach($datas as $key){
            array_push($discount, ($key->diskon / 100 * $key->subtotal));
        }
        $diskon =array_sum($discount);
        return response()->json(['data' => $data,'diskon' => $diskon],200);

    }

    public function cetakNota(Request $request)
    {
        $nota= $request->kwitansi;
        $data =Penjualans::joincetak()
                ->where('penjualans.nota', $nota)
                ->get();
        $bruto = Penjualans::joincetak()
                ->where('penjualans.nota', $nota)
                ->select(DB::raw('SUM(subtotal) as bruto'))
                ->groupBy('penjualans.nota')
                ->get();
        $pdf = PDF::loadView('admin.cetakNota',compact('data','bruto'));
        return $pdf->download('invoice.pdf');
    }
}
