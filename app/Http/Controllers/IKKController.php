<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

use App\Models\IKK;
use App\Models\SK;
use App\Models\CapaianIKK;

class IKKController extends Controller
{   
    public function input()
    {
        $user = Auth::user();
        // $data = SK::where('pelaksana', $user->eselon)->get();
        $ikk = IKK::orWhere(function($query) {
            $user = Auth::user();
            $data = SK::where('pelaksana', $user->eselon)->get();
            foreach ($data as $key => $value) {
                $query->orWhere('sk_id', $value->id);
            }
        })->get();
        // return $ikk;
        return view('pages/ikk/input', ['user'=>$user,'ikk'=>$ikk]);
    }
    public function destroy($id){
        $master = CapaianIKK::findOrFail($id);
        $master->delete();

        return redirect('list-ikk')->with('success', 'Data berhasil di Hapus'); 
    }
    public function list(Request $request)
    {
        $user = Auth::user();
        $data = SK::where('pelaksana', $user->eselon)->get();
        $bulan = $request->input('bulan');
        if($bulan == null || $bulan == ''){
            $bulan = date('m');
            // $request->input('bulan') = $bulan;
        }

        foreach ($data as $key => $sk) {
            $ikk = IKK::where('sk_id', $sk->id)->get();
            foreach ($ikk as $key => $value) {
                $capaian = CapaianIKK::where('pelaksana', $user->eselon)->where('ikk_id', $value->id)->whereMonth('created_at', '=', $bulan)->first();
                $value->capaian_id = !empty($capaian['id']) ? $capaian['id'] : '';
                $value->capaian = !empty($capaian['capaian']) ? $capaian['capaian'] : '';
                $value->analisa = !empty($capaian['analisa']) ? $capaian['analisa'] : '';
                $value->kegiatan = !empty($capaian['kegiatan']) ? $capaian['kegiatan'] : '';
                $value->kendala_hambatan = !empty($capaian['kendala_hambatan']) ? $capaian['kendala_hambatan'] : '';
            }
            $sk->ikk = $ikk;
        }

        return view('pages/ikk/list', ['data' => $data, 'user'=>$user,'params'=>$request]);  


        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $bulan = date('m', strtotime($request->created_at));
        $bulanString = date('F', strtotime($request->created_at));
        // return $request;
        $user = Auth::user();
        $cek = CapaianIKK::where('ikk_id',$request->ikk)->whereMonth('created_at', '=', $bulan)->count();
        $ikk = IKK::findOrFail($request->ikk);
        // return $cek;
        if($cek < 1){
            $data = CapaianIKK::create([
                'ikk_id' => $request->ikk,
                'pelaksana' => $user->eselon,
                'capaian' => $request->capaian,
                'analisa' => $request->analisa,
                'kegiatan' => $request->kegiatan,
                'kendala_hambatan' => $request->kendala_hambatan,
                'created_at' =>$request->created_at,
                'user_id'=> $user->id,
            ]);
            if($data){
                return redirect('list-ikk?bulan='.$bulan)->with('success', 'Realisasi Indikator '. $ikk->deskripsi.' Bulan '.$bulanString.' Berhasil di Input'); 
            }
        }else{
            return redirect('input-form-ikk')->with('error', 'Realisasi Bulan '.$bulanString.' Untuk Indikator '. $ikk->deskripsi.' Sudah di Input');
        }
    }
}
