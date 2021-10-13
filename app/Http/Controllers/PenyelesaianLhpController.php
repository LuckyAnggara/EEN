<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

use App\Models\PenyelesaianLhp;

class PenyelesaianLhpController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        return view('pages/penyelesaian_lhp/input', ['user'=>$user]);
    }

    public function destroy($id){
        $master = PenyelesaianLhp::findOrFail($id);
        $master->delete();

        return redirect('list-penyelesaian-lhp')->with('success', 'Data berhasil di Hapus'); 
    }


    public function list(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->input('bulan');
        $cari = $request->input('cari');

        $data = PenyelesaianLhp::where('user_id', $user->id)->where('nomor_surat_perintah', 'LIKE', "%{$cari}%"
        )->get();

        if($bulan != 0){
            $data = PenyelesaianLhp::where('user_id',$user->id)->whereMonth('created_at', '=', $bulan)->where('nomor_surat_perintah', 'LIKE', "%{$cari}%")->get();
        }
        // return $data;

        return view('pages/penyelesaian_lhp/list', ['data' => $data, 'user'=>$user,'params' => $request]);

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = PenyelesaianLhp::create([
            'nomor_surat_perintah' => $request->nomor_surat_perintah,
            'tanggal_surat_perintah' => $request->tanggal_surat_perintah,
            'created_at' => $request->tanggal_surat_perintah,
            'nomor_lhp' => $request->nomor_lhp,
            'keterangan'=> $request->keterangan,
            'user_id'=> $user->id,
        ]);
        if($data){
            return redirect('list-penyelesaian-lhp'); 
        }
        return response()->json($data, 200);
    }

}
