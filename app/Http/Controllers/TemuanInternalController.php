<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TemuanInternal;

class TemuanInternalController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        return view('pages/temuan_internal/input', ['user'=>$user]);
    }

    public function destroy($id){
        $master = TemuanInternal::findOrFail($id);
        $master->delete();

        return redirect('list-temuan-internal')->with('success', 'Data berhasil di Hapus'); 
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->input('bulan');
        $cari = $request->input('cari');

        $data = TemuanInternal::where('user_id', $user->id)->where('obrik', 'LIKE', "%{$cari}%"
        )->get();

        if($bulan != 0){
            $data = TemuanInternal::where('user_id',$user->id)->whereMonth('created_at', '=', $bulan)->where('obrik', 'LIKE', "%{$cari}%")->get();
        }
        // return $data;
        $temuan_jumlah_total = 0;
        $temuan_nominal_total = 0;
        $sudah_tl_jumlah_total = 0;
        $sudah_tl_nominal_total = 0;
        $belum_tl_jumlah_total = 0;
        $belum_tl_nominal_total = 0;

        foreach ($data as $key => $value) {
            $temuan_jumlah_total = $temuan_jumlah_total + $value->temuan_jumlah;
            $temuan_nominal_total = $temuan_nominal_total + $value->temuan_nominal;
            $sudah_tl_jumlah_total = $sudah_tl_jumlah_total + $value->sudah_tl_jumlah;
            $sudah_tl_nominal_total = $sudah_tl_nominal_total + $value->sudah_tl_nominal;
            $belum_tl_jumlah_total = $belum_tl_jumlah_total + $value->belum_tl_jumlah;
            $belum_tl_nominal_total = $belum_tl_nominal_total + $value->belum_tl_nominal;
        }

        $rekom['temuan_jumlah_total'] = $temuan_jumlah_total;
        $rekom['temuan_nominal_total'] = $temuan_nominal_total;
        $rekom['sudah_tl_jumlah_total'] = $sudah_tl_jumlah_total;
        $rekom['sudah_tl_nominal_total'] = $sudah_tl_nominal_total;
        $rekom['belum_tl_jumlah_total'] = $belum_tl_jumlah_total;
        $rekom['belum_tl_nominal_total'] = $belum_tl_nominal_total;

        // $jumlah['rekomendasi_jumlah_nominal'] = $rekomendasi_jumlah_nominal;
        // return $data;
        return view('pages/temuan_internal/list', [
            'data' => $data, 
            'user'=> $user,
            'params' => $request, 
        ], $rekom);

    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = TemuanInternal::create([
            'obrik' => $request->obrik,
            // 'tahun' => $request->tahun,
            'temunan_jumlah' => $request->temuan_jumlah,
            'temuan_nominal' => $request->temuan_nominal,
            'sudah_tl_jumlah'=> $request->sudah_tl_jumlah,
            'sudah_tl_nominal'=> $request->sudah_tl_nominal,
            'belum_tl_jumlah'=> $request->belum_tl_jumlah,
            'belum_tl_nominal'=> $request->belum_tl_nominal,
            'user_id'=> $user->id,
        ]);
        if($data){
            return redirect('list-temuan-internal'); 
        }
        return response()->json($data, 200);
    }
}
