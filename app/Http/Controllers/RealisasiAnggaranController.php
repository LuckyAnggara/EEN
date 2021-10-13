<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JenisAnggaran;
use App\Models\RealisasiAnggaran;

class RealisasiAnggaranController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        $jenis_anggaran = JenisAnggaran::all();
        $jenis = [
            'INSPEKTORAT WILAYAH I',
            'INSPEKTORAT WILAYAH II',
            'INSPEKTORAT WILAYAH III',
            'INSPEKTORAT WILAYAH IV',
            'INSPEKTORAT WILAYAH V',
            'INSPEKTORAT WILAYAH VI',
            'DUKUNGAN MANAJEMEN',
        ];
        foreach ($jenis as $key => $value) {
            $data[$value] = JenisAnggaran::where('jenis_kegiatan', $value)->get();
        }
        // return $data;
        return view('pages/realisasi_anggaran/input', ['user'=>$user, 'data'=> $data]);
    }

    public function destroy($id){
        $master = RealisasiAnggaran::findOrFail($id);
        $master->delete();

        return redirect('list-realisasi-anggaran')->with('success', 'Data berhasil di Hapus'); 
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->input('bulan');

        $data = RealisasiAnggaran::select('realisasi_anggaran.*','realisasi_anggaran.id as realisasi_id','jenis_anggaran.*')->where('realisasi_anggaran.user_id', $user->id)->join('jenis_anggaran', 'realisasi_anggaran.kro_id', '=', 'jenis_anggaran.id')->get();

        if($bulan != 0){
            $data = RealisasiAnggaran::select('realisasi_anggaran.*','realisasi_anggaran.id as realisasi_id','jenis_anggaran.*')->where('user_id',$user->id)->join('jenis_anggaran', 'realisasi_anggaran.kro_id', '=', 'jenis_anggaran.id')->whereMonth('created_at', '=', $bulan)->get();
        }

        $total_pagu =0;
        $total_realisasi =0;
        $total_sisa =0;
        foreach ($data as $key => $value) {
            $total_pagu =+ $value->pagu;   
            $total_realisasi =+ $value->realisasi;   
            $total_sisa =+ $value->sisa;   
        }
        // return $data;

        return view('pages/realisasi_anggaran/list', 
        [
            'data' => $data, 
            'user'=>$user,
            'params' => $request,
            'total_pagu'=> $total_pagu,
            'total_realisasi'=> $total_realisasi,
            'total_sisa'=> $total_sisa,
        ]);

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = RealisasiAnggaran::create([
            'kro_id' => $request->kro_id,
            'pagu' => $request->pagu,
            'realisasi' => $request->realisasi,
            'sisa' => $request->sisa,
            'user_id'=> $user->id,
            'created_at'=> $request->created_at,
        ]);
        if($data){
            return redirect('list-realisasi-anggaran'); 
        }
        return response()->json($data, 200);
    }
}
