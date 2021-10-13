<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TemuanEksternal;

class TemuanEksternalController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        return view('pages/temuan_eksternal/input', ['user'=>$user]);
    }

    public function destroy($id){
        $master = TemuanEksternal::findOrFail($id);
        $master->delete();

        return redirect('list-temuan-internal')->with('success', 'Data berhasil di Hapus'); 
    }


    public function list(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->input('bulan');
        $cari = $request->input('cari');

        $data = TemuanEksternal::where('user_id', $user->id)->where('obrik', 'LIKE', "%{$cari}%"
        )->get();

        if($bulan != 0){
            $data = TemuanEksternal::where('user_id',$user->id)->whereMonth('created_at', '=', $bulan)->where('obrik', 'LIKE', "%{$cari}%")->get();
        }
        // return $data;
        $rekomendasi_jumlah_total = 0;
        $rekomendasi_nominal_total = 0;
        $selesai_jumlah_total = 0;
        $selesai_nominal_total = 0;
        $proses_tl_jumlah_total = 0;
        $proses_tl_nominal_total = 0;
        $belum_tl_jumlah_total = 0;
        $belum_tl_nominal_total = 0;
        $setor_uang_ke_negara_total = 0;

        foreach ($data as $key => $value) {
            $rekomendasi_jumlah_total = $rekomendasi_jumlah_total + $value->rekomendasi_jumlah;
            $rekomendasi_nominal_total = $rekomendasi_nominal_total + $value->rekomendasi_nominal;
            $selesai_jumlah_total = $selesai_jumlah_total + $value->selesai_jumlah;
            $selesai_nominal_total = $selesai_nominal_total + $value->selesai_nominal;
            $proses_tl_jumlah_total = $proses_tl_jumlah_total + $value->proses_tl_jumlah;
            $proses_tl_nominal_total = $proses_tl_nominal_total + $value->proses_tl_nominal;
            $belum_tl_jumlah_total = $belum_tl_jumlah_total + $value->belum_tl_jumlah;
            $belum_tl_nominal_total = $belum_tl_nominal_total + $value->belum_tl_nominal;
            $setor_uang_ke_negara_total = $setor_uang_ke_negara_total + $value->setor_uang_ke_negara;
        }

        $rekom['rekomendasi_jumlah_total'] = $rekomendasi_jumlah_total;
        $rekom['rekomendasi_nominal_total'] = $rekomendasi_nominal_total;
        $rekom['selesai_jumlah_total'] = $selesai_jumlah_total;
        $rekom['selesai_nominal_total'] = $selesai_nominal_total;
        $rekom['proses_tl_jumlah_total'] = $proses_tl_jumlah_total;
        $rekom['proses_tl_nominal_total'] = $proses_tl_nominal_total;
        $rekom['belum_tl_jumlah_total'] = $belum_tl_jumlah_total;
        $rekom['belum_tl_nominal_total'] = $belum_tl_nominal_total;
        $rekom['setor_uang_ke_negara_total'] = $setor_uang_ke_negara_total;

        // $jumlah['rekomendasi_jumlah_nominal'] = $rekomendasi_jumlah_nominal;

        return view('pages/temuan_eksternal/list', [
            'data' => $data, 
            'user'=> $user,
            'params' => $request, 
        ], $rekom);

    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = TemuanEksternal::create([
            'obrik' => $request->obrik,
            'tahun' => $request->tahun,
            'rekomendasi_jumlah' => $request->rekomendasi_jumlah,
            'rekomendasi_nominal' => $request->rekomendasi_nominal,
            'sesuai_jumlah' => $request->sesuai_jumlah,
            'sesuai_nominal'=> $request->sesuai_nominal,
            'proses_tl_jumlah'=> $request->proses_tl_jumlah,
            'proses_tl_nominal'=> $request->proses_tl_nominal,
            'belum_tl_jumlah'=> $request->belum_tl_jumlah,
            'belum_tl_nominal'=> $request->belum_tl_nominal,
            'setor_uang_ke_negara'=> $request->setor_uang_ke_negara,
            'user_id'=> $user->id,
        ]);
        if($data){
            return redirect('list-temuan-eksternal'); 
        }
        return response()->json($data, 200);
    }
}
