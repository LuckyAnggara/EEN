<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Kompetensi;

class KompetensiController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        return view('pages/kompetensi/input', ['user'=>$user]);
    }

    public function destroy($id){
        $master = Kompetensi::findOrFail($id);
        $master->delete();

        return redirect('list-kompetensi')->with('success', 'Data berhasil di Hapus'); 
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->input('bulan');
        $cari = $request->input('cari');

        $data = Kompetensi::where('user_id', $user->id)->where('nama', 'LIKE', "%{$cari}%"
        )->get();

        if($bulan != 0){
            $data = Kompetensi::where('user_id',$user->id)->whereMonth('created_at', '=', $bulan)->where('nama', 'LIKE', "%{$cari}%")->get();
        }
        // return $data;

        return view('pages/kompetensi/list', ['data' => $data, 'user'=>$user,'params' => $request]);

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = Kompetensi::create([
            'nama' => $request->nama,
            'jumlah_peserta' => $request->jumlah_peserta,
            'waktu_penyelenggaraan' => $request->waktu_penyelenggaraan,
            'jumlah_hari' => $request->jumlah_hari,
            'peserta' => $request->peserta,
            'created_at' => $request->created_at,
            'user_id'=> $user->id,
        ]);
        if($data){
            return redirect('list-kompetensi'); 
        }
        return response()->json($data, 200);
    }
}
