<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\SuratMasuk;

class SuratMasukController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        return view('pages/surat_masuk/input', ['user'=>$user]);
    }

    public function destroy($id){
        $master = SuratMasuk::findOrFail($id);
        $master->delete();

        return redirect('list-surat-masuk')->with('success', 'Data berhasil di Hapus'); 
    }


    public function list(Request $request)
    {
        $user = Auth::user();
        $data = [];
        $bulan = [1,2,3,4,5,6,7,8,9,10,11,12
        ];
        $isi = [];
        foreach ($bulan as $key => $value) {
           $bulanString = date('F', mktime(0, 0, 0, $value, 10));
           $isi = SuratMasuk::where('user_id',$user->id)->whereMonth('created_at', '=', $value)->first();
           if(!empty($isi)){
                $isi->bulan = $bulanString;
               $data[]=$isi;

           }
        }
        // return $data;

        return view('pages/surat_masuk/list', ['data' => $data, 'user'=>$user,'params' => $request]);

    }

    public function store(Request $request)
    {
        $bulan = $request->created_at;
        $user = Auth::user();
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));
        $cek = SuratMasuk::whereMonth('created_at', '=', $bulan)->where('user_id', $user->id)->count();
        // return $cek.$bulanString;

        if($user->level == 'ESELON II'){
            $pelaksana = $user->eselon;
        }else if($user->level == 'ESELON III'){
            $pelaksana = $user->eselon_3;
        }

        if($cek < 1){
            $data = SuratMasuk::create([
                'pelaksana' => $pelaksana   ,
                'surat' => $request->surat,
                'created_at'=> date('Y-'.$request->created_at.'-31'),
                'user_id'=> $user->id,
            ]);
            if($data){
                return redirect('list-surat-masuk?bulan='.$bulan)->with('success', 'Realisasi Surat Masuk Bulan '.$bulanString.' Berhasil di Input'); 
            }  
        }else{
            return redirect('input-form-surat-masuk')->with('error', 'Realisasi Bulan '.$bulanString.' Sudah di Input');
        }
        
        if($data){
            return redirect('list-surat-masuk'); 
        }
        return response()->json($data, 200);
    }
}
