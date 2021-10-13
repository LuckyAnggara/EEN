<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\KinerjaLainnya;

class KinerjaLainnyaController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        if($user->level =='ESELON II'){
            $pelaksana = $user->eselon;
        }else if($user->level =='ESELON III'){
            $pelaksana = $user->eselon_3;
        }
        return view('pages/kinerja_lainnya/input', ['user'=>$user, 'pelaksana'=>$pelaksana]);
    }

    public function destroy($id){
        $master = KinerjaLainnya::findOrFail($id);
        $master->delete();

        return redirect('list-surat-masuk')->with('success', 'Data berhasil di Hapus'); 
    }


    public function list(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->input('bulan');
        $cari = $request->input('cari');

        $data = KinerjaLainnya::where('user_id', $user->id)->where('kegiatan', 'LIKE', "%{$cari}%"
        )->get();

        if($bulan != 0){
            $data = KinerjaLainnya::where('user_id',$user->id)->whereMonth('created_at', '=', $bulan)->where('nama', 'LIKE', "%{$cari}%")->get();
        }
        // return $data;

        return view('pages/kinerja_lainnya/list', ['data' => $data, 'user'=>$user,'params' => $request]);

    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = KinerjaLainnya::create([
            'pelaksana' => $request->pelaksana,
            'kegiatan' => $request->kegiatan,
            'created_at' => $request->created_at,
            'user_id'=> $user->id,
        ]);
        if($data){
            return redirect('list-kinerja-lainnya'); 
        }
        return response()->json($data, 200);
    }
}
