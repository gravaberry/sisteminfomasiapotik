<?php

namespace App\Http\Controllers;

use App\Models\Pembelians;
use App\Models\Penjualans;
use Illuminate\Http\Request;
use Carbon\Carbon;
class LaporaController extends Controller
{
    public function index()
    {
        return view('admin.laporan');
    }

    public function dataTablePenjualan(Request $request)
    {



        if(request()->ajax())
        {
            if(!empty($request->min)){
                $data =Penjualans::joincetak()
                ->whereBetween('penjualans.created_at',[$request->min, $request->max])
                ->groupBy('penjualans.nota')
                ->get();
            }else{
                $data =Penjualans::join()
                ->groupBy('penjualans.nota')
                ->get();
            }
            return datatables()->of($data)
                ->addColumn('aksi', function($data){
                    $button ='<button class="detailsJual btn btn-sm btn-warning" id="'.$data->nota.'" name="detail">Details</button>';

                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

    }

    public function dataTablePembelian(Request $request)
    {
        $data =Pembelians::join()
                ->select('pembelians.*','supliers.nama as supplier','users.name as admin')
                ->get();
        if(request()->ajax())
        {
            return datatables()->of($data)
                ->addColumn('aksi', function($data){
                    $button ='<button class="detailsBeli btn btn-sm btn-warning" id="'.$data->faktur.'" name="Detail">Detail</button>';

                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function detailJual(Request $request)
    {
        $nota =$request->nota;
        $data =Penjualans::join()
                ->where('penjualans.nota', $nota)
                ->get();
        if(request()->ajax())
        {
            return datatables()->of($data)
                ->make(true);
        }

    }
    public function detailBeli(Request $request)
    {
        $faktur =$request->faktur;
        $data =Pembelians::join()
                ->where('pembelians.faktur', $faktur)
                ->select('pembelians.*','supliers.nama as supplier','users.name as admin')
                ->get();
        if(request()->ajax())
        {
            return datatables()->of($data)
                ->make(true);
        }

    }


    public function records(Request $request)
    {
        if ($request->ajax()) {

            if ($request->input('start_date') && $request->input('end_date')) {

                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));

                if ($end_date->greaterThan($start_date)) {
                    $penjualans = Penjualans::whereBetween('created_at', [$start_date, $end_date])->get();
                } else {
                    $penjualans = Penjualans::latest()->get();
                }
            } else {
                $penjualans = Penjualans::latest()->get();
            }

            return response()->json([
                'penjualans' => $penjualans
            ]);
        } else {
            abort(403);
        }
    }
}
