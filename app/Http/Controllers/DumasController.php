<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

use App\Models\Dumas;
use App\Models\Satker;

class DumasController extends Controller
{
    public function input()
    {
        $user = Auth::user();
        $satker = Satker::all();
        // return $ikk;
        return view('pages/dumas/input', ['user'=>$user,'data'=>$satker]);
    }

    public function edit($bulan)
    {
        $data= Dumas::select('dumas.*','satker.nama as nama_unit')->join('satker', 'dumas.satker_id', '=', 'satker.id')->whereMonth('created_at', '=', $bulan)->get();
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));
        return view('pages/dumas/edit', ['data' => $data,'bulan'=>$bulan, 'bulanString'=> $bulanString]);

        return $data;
    }

    public function list(Request $request){
        
        $user = Auth::user();
        $satker = Satker::all();
        $bulan = $request->input('bulan');
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));

        if($bulan == null || $bulan == ''){
            $bulan = date('m');
        }

        foreach ($satker as $key => $value) {
            $dumas = Dumas::where('satker_id', $value->id)->whereMonth('created_at', '=', $bulan)->first();
            $value->dumas = $dumas;
        }
        if($satker[0]->dumas == null){
            return view('pages/dumas/list', ['bulanString'=>$bulanString, 'data' => $satker, 'user'=>$user,'params'=>$request, 'warning'=>'Belum ada Data Pengaduan Masyarakat di Bulan '.$bulanString.', silahkan lakukan    ']);
        }
        return view('pages/dumas/list', ['bulanString'=>$bulanString, 'data' => $satker, 'user'=>$user,'params'=>$request]);
    }

    public function update(Request $request)
    {
        // return $request;
        $bulan = $request->bulan;
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));

        foreach ($request->id as $key => $id) {
            $master = Dumas::findOrFail($id);
            $master->berkas_masuk = $request->berkas_masuk[$id];
            $master->proses_auditor = $request->proses_auditor[$id];
            $master->proses_irjen = $request->proses_irjen[$id];
            $master->proses_menteri = $request->proses_menteri[$id];
            $master->proses_kanwil = $request->proses_kanwil[$id];
            $master->jumlah_selesai = $request->jumlah_selesai[$id];
            $master->save();
        }
        return redirect('list-dumas?bulan='.$bulan)->with('success', 'Realisasi Pengaduan Masyarakat Bulan '.$bulanString.' Berhasil di Perbaharui'); 
     
    }

    public function store(Request $request)
    {
        $bulan = $request->created_at;
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));
        $user = Auth::user();
        $satker = Satker::all();
        $cek = Dumas::whereMonth('created_at', '=', $bulan)->count();
        // return $cek.$bulanString;

        if($cek < 1){
            foreach ($satker as $key => $satker) {
                $data[] = Dumas::create([
                    'satker_id'=> $satker->id,
                    'berkas_masuk'=> $request['berkas_masuk_'.$satker->id],
                    'proses_auditor'=> $request['proses_auditor_'.$satker->id],
                    'proses_irjen'=> $request['proses_irjen_'.$satker->id],
                    'proses_menteri'=> $request['proses_menteri_'.$satker->id],
                    'proses_kanwil'=> $request['proses_kanwil_'.$satker->id],
                    'jumlah_selesai'=> $request['jumlah_selesai_'.$satker->id],
                    'user_id'=> $user->id,
                    'created_at'=> date('Y-'.$request->created_at.'-31'),
                ]);
            }
            if($data){
                return redirect('list-dumas?bulan='.$bulan)->with('success', 'Realisasi Pengaduan Masyarkat Bulan '.$bulanString.' Berhasil di Input'); 
            }  
        }else{
            return redirect('input-form-dumas')->with('error', 'Realisasi Bulan '.$bulanString.' Sudah di Input');
        }
      
    }
    
    public function destroy($bulan)
    {
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));
        $master = Dumas::whereMonth('created_at', $bulan)->get();
        foreach ($master as $key => $value) {
            $value->delete();
        }
        return redirect('list-dumas?bulan='.$bulan)->with('success', 'Realisasi Pengaduan Masyarakat Bulan '.$bulanString.' di Hapus'); 
    }
}
