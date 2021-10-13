<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        return view('pages/kegiatan/input', ['user'=>$user]);
    }

    public function destroy($id){
        $master = Kegiatan::findOrFail($id);
        $master->delete();

        return redirect('list-kegiatan')->with('success', 'Data berhasil di Hapus'); 
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->input('bulan');
        $cari = $request->input('cari');

        $data = Kegiatan::where('user_id', $user->id)->where('nama', 'LIKE', "%{$cari}%"
        )->get();

        if($bulan != 0){
            $data = Kegiatan::where('user_id',$user->id)->whereMonth('created_at', '=', $bulan)->where('nama', 'LIKE', "%{$cari}%")->get();
        }
        // return $data;

        return view('pages/kegiatan/list', ['data' => $data, 'user'=>$user,'params' => $request]);

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = Kegiatan::create([
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'pelaksana' => $user->eselon,
            'surat_perintah' => $request->surat_perintah,
            'tanggal_surat_perintah' => $request->tanggal_surat_perintah,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'lokasi' => $request->lokasi,
            'temuan' => $request->temuan,
            'created_at' =>$request->created_at,
            'user_id'=> $user->id,
        ]);
        if($data){
            return redirect('list-kegiatan'); 
        }
        return response()->json($data, 200);
    }

}
