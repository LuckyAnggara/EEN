<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

use App\Models\Hukdis;
use App\Models\Satker;

class HukdisController extends Controller
{
    public function edit($bulan)
    {
        $data= Hukdis::select('hukdis.*','satker.nama as nama_unit')->join('satker', 'hukdis.satker_id', '=', 'satker.id')->whereMonth('created_at', '=', $bulan)->get();
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));
        return view('pages/hukdis/edit', ['data' => $data,'bulan'=>$bulan, 'bulanString'=> $bulanString]);

        return $data;
    }


    public function input()
    {
        $user = Auth::user();
        $satker = Satker::all();
        // return $ikk;
        return view('pages/hukdis/input', ['user'=>$user,'data'=>$satker]);
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
            $hukdis = Hukdis::where('satker_id', $value->id)->whereMonth('created_at', '=', $bulan)->first();
            $value->hukdis = $hukdis;
        }
        if($satker[0]->hukdis == null){
            return view('pages/hukdis/list', ['bulanString'=>$bulanString, 'data' => $satker, 'user'=>$user,'params'=>$request, 'warning'=>'Belum ada Data Hukuman Disiplin di Bulan '.$bulanString.', silahkan lakukan    ']);
        }
        return view('pages/hukdis/list', ['bulanString'=>$bulanString, 'data' => $satker, 'user'=>$user,'params'=>$request]);
    }

    public function store(Request $request)
    {
        $bulan = $request->created_at;
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));
        $user = Auth::user();
        $satker = Satker::all();
        $cek = Hukdis::whereMonth('created_at', '=', $bulan)->count();
        // return $cek.$bulanString;

        if($cek < 1){
            foreach ($satker as $key => $satker) {
                $data[] = Hukdis::create([
                    'satker_id'=> $satker->id,
                    'berkas_masuk'=> $request['berkas_masuk_'.$satker->id],
                    'proses_auditor'=> $request['proses_auditor_'.$satker->id],
                    'proses_irjen'=> $request['proses_irjen_'.$satker->id],
                    'proses_menteri'=> $request['proses_menteri_'.$satker->id],
                    'proses_setjen'=> $request['proses_setjen'.$satker->id],
                    'proses_satker'=> $request['proses_satker'.$satker->id],
                    'sk_terbit'=> $request['sk_terbit'.$satker->id],
                    'user_id'=> $user->id,
                    'created_at'=> date('Y-'.$request->created_at.'-31'),
                ]);
            }
            if($data){
                return redirect('list-hukdis?bulan='.$bulan)->with('success', 'Realisasi Hukuman Disiplin Bulan '.$bulanString.' Berhasil di Input'); 
            }  
        }else{
            return redirect('input-form-hukdis')->with('error', 'Realisasi Bulan '.$bulanString.' Sudah di Input');
        }
      
    }

    public function update(Request $request)
    {
        // return $request;
        $bulan = $request->bulan;
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));

        foreach ($request->id as $key => $id) {
            $master = Hukdis::findOrFail($id);
            $master->berkas_masuk = $request->berkas_masuk[$id];
            $master->proses_auditor = $request->proses_auditor[$id];
            $master->proses_irjen = $request->proses_irjen[$id];
            $master->proses_menteri = $request->proses_menteri[$id];
            $master->proses_setjen = $request->proses_setjen[$id];
            $master->proses_satker = $request->proses_satker[$id];
            $master->sk_terbit = $request->sk_terbit[$id];
            $master->save();
        }
        return redirect('list-hukdis?bulan='.$bulan)->with('success', 'Realisasi Hukuman Disiplin Bulan '.$bulanString.' Berhasil di Perbaharui');       
    }

    public function destroy($bulan)
    {
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));
        $master = Hukdis::whereMonth('created_at', $bulan)->get();
        foreach ($master as $key => $value) {
            $value->delete();
        }
        return redirect('list-hukdis?bulan='.$bulan)->with('success', 'Realisasi Hukuman Disiplin Bulan '.$bulanString.' di Hapus'); 
    }
}
