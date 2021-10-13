<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

use App\Models\IKK;
use App\Models\IKU;
use App\Models\CapaianIKU;
use App\Models\SK;
use App\Models\SS;

class IKUController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        $iku = IKU::all();
        // return $iku;
        return view('pages/iku/input', ['user'=>$user,'iku'=>$iku]);
    }

    public function destroy($id){
        $master = CapaianIKU::findOrFail($id);
        $master->delete();

        return redirect('list-iku')->with('success', 'Data berhasil di Hapus'); 
    }

    public function list(Request $request)
    {
        $data = SS::all();

        $user = Auth::user();
        $bulan = $request->input('bulan');

        if($bulan == null || $bulan == ''){
            $bulan = date('m');
        }

        foreach ($data as $key => $ss) {
            $iku = IKU::where('ss_id', $ss->nomor)->get();
            foreach ($iku as $key => $value) {
                $capaian = CapaianIKU::where('iku_id', $value->id)->whereMonth('created_at', '=', $bulan)->first();
                $value->capaian_id = !empty($capaian['id']) ? $capaian['id'] : '';
                $value->capaian = !empty($capaian['capaian']) ? $capaian['capaian'] : '';
                $value->analisa = !empty($capaian['analisa']) ? $capaian['analisa'] : '';
                $value->kegiatan = !empty($capaian['kegiatan']) ? $capaian['kegiatan'] : '';
                $value->kendala_hambatan = !empty($capaian['kendala_hambatan']) ? $capaian['kendala_hambatan'] : '';
            }
            $ss->iku = $iku;
        }

        return view('pages/iku/list', ['data' => $data, 'user'=>$user,'params'=>$request]);


        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $bulan = date('m', strtotime($request->created_at));
        $bulanString = date('F', strtotime($request->created_at));
        // return $bulanString;
        $user = Auth::user();
        $cek = CapaianIKU::where('iku_id',$request->iku)->whereMonth('created_at', '=', $bulan)->count();
        $iku = IKU::findOrFail($request->iku);
        // return $cek;
        if($cek < 1){
            $data = CapaianIKU::create([
                'iku_id' => $request->iku,
                'capaian' => $request->capaian,
                'analisa' => $request->analisa,
                'kegiatan' => $request->kegiatan,
                'kendala_hambatan' => $request->kendala_hambatan,
                'created_at' =>$request->created_at,
                'user_id'=> $user->id,
            ]);
            if($data){
                return redirect('list-iku?bulan='.$bulan)->with('success', 'Realisasi Indikator '. $iku->deskripsi.' Bulan '.$bulanString.' Berhasil di Input'); 
            }
        }else{
            return redirect('input-form-iku')->with('error', 'Realisasi Bulan '.$bulanString.' Untuk Indikator '. $iku->deskripsi.' Sudah di Input');
        }
    }
}
