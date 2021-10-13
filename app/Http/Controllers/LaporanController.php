<?php

namespace App\Http\Controllers;

use App\Models\CapaianIKK;
use App\Models\CapaianIKU;
use App\Models\Dumas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Files;
use App\Models\Hukdis;
use App\Models\IKK;
use App\Models\IKU;
use App\Models\Kegiatan;
use App\Models\JenisAnggaran;
use App\Models\RealisasiAnggaran;
use App\Models\Kompetensi;
use App\Models\SuratMasuk;
use App\Models\KinerjaLainnya;
use App\Models\PenyelesaianLhp;
use App\Models\Satker;
use App\Models\SK;
use App\Models\SS;
use App\Models\TemuanEksternal;
use App\Models\TemuanInternal;
use App\Models\User;

class LaporanController extends Controller
{
    public function inputUnit()
    {
        $file = Files::all()->count();
        $user = Auth::user();
        return view('pages/laporan/inspektorat_jenderal/input', ['user'=>$user,'file'=> $file]);
    }

    public function uploadTemplate(Request $request){
        $request->validate([
            'file' => 'required|mimes:doc,docx'
        ]);
            $file = Files::all();
            $fileCount = $file->count();
            if($fileCount > 0){
                $fileModel = $file[0];
            }else{
                $fileModel = new Files;
            }
    
            if($request->file()) {
                // $fileName = time().'_'.$req->file->getClientOriginalName();
                $extension = $request->file->extension();
                $fileName = 'template_laporan.'.$extension;
                
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
    
                // $fileModel->name = time().'_'.$request->file->getClientOriginalName();
                $fileModel->nama = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();
    
                return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
        }
    }

    // DATA
    function dataIku($bulan){
        $data = SS::all();
        foreach ($data as $key => $ss) {
            $iku = IKU::where('ss_id', $ss->nomor)->get();
            foreach ($iku as $key => $value) {
                $capaian = CapaianIKU::where('iku_id', $value->id)->whereMonth('created_at', '=', $bulan)->first();
                $value->capaian = !empty($capaian['capaian']) ? $capaian['capaian'] : '';
                $value->analisa = !empty($capaian['analisa']) ? $capaian['analisa'] : '';
                $value->kegiatan = !empty($capaian['kegiatan']) ? $capaian['kegiatan'] : '';
                $value->kendala_hambatan = !empty($capaian['kendala_hambatan']) ? $capaian['kendala_hambatan'] : '';
            }
            $ss->iku = $iku;
        }
        return $data;
    }

    function dataIKK($bulan){
        $bulan = $bulan;
        $eselon = [
            'INSPEKTORAT WILAYAH I',
            'INSPEKTORAT WILAYAH II',
            'INSPEKTORAT WILAYAH III',
            'INSPEKTORAT WILAYAH IV',
            'INSPEKTORAT WILAYAH V',
            'INSPEKTORAT WILAYAH VI',
            'SEKRETARIAT INSPEKTORAT JENDERAL',
        ];
        foreach ($eselon as $key => $eselon) {
        $data[$eselon] = SK::where('pelaksana', $eselon)->get();
           foreach ($data[$eselon] as $key => $sk) {
                $ikk = IKK::where('sk_id', $sk->id)->get();
                foreach ($ikk as $key => $value) {
                    $capaian = CapaianIKK::where('pelaksana', $eselon)->where('ikk_id', $value->id)->whereMonth('created_at', '=', $bulan)->first();
                    $value->capaian = !empty($capaian['capaian']) ? $capaian['capaian'] : '';
                    $value->analisa = !empty($capaian['analisa']) ? $capaian['analisa'] : '';
                    $value->kegiatan = !empty($capaian['kegiatan']) ? $capaian['kegiatan'] : '';
                    $value->kendala_hambatan = !empty($capaian['kendala_hambatan']) ? $capaian['kendala_hambatan'] : '';
                }
                $sk->ikk = $ikk;
           }
        }
        return $data;
    }

    function dataKegiatan($bulan){
        $details = Kegiatan::whereMonth('created_at', $bulan)->get();
        // return $details;
        $output =[];
        $jenis_kegiatan = array('AUDIT','REVIU','EVALUASI','PEMANTAUAN','PENGAWASAN LAINNYA','DUKUNGAN MANAJEMEN');

        foreach ($jenis_kegiatan as $key => $value) {
            $ret = array();
            $data = Kegiatan::where('jenis',$value)->get();
            foreach ($data as $key => $val) {
                $ret[$val['pelaksana']][] = $val;
            }
            $output[$value] = $ret;
        }

        return $output;
    }

    function dataKinerjaLainnya($bulan){
        $eselon = [
            'INSPEKTORAT WILAYAH I',
            'INSPEKTORAT WILAYAH II',
            'INSPEKTORAT WILAYAH III',
            'INSPEKTORAT WILAYAH IV',
            'INSPEKTORAT WILAYAH V',
            'INSPEKTORAT WILAYAH VI',
            'PROGRAM HUBUNGAN MASYARAKAT DAN PELAPORAN',
            'UMUM',
            'SISITEM INFORMASI PENGAWASAN',
            'KEUANGAN',
            'KEPEGAWAIAN'
        ];
        foreach ($eselon as $key => $eselon) {
            $output[$eselon] = KinerjaLainnya::where('pelaksana',$eselon)->whereMonth('created_at', $bulan)->get();
        }

        return $output;
    }

    function dataPenyelesaianLHP($bulan){
        $details = PenyelesaianLhp::select('penyelesaian_lhp.*','users.name')->join('users', 'penyelesaian_lhp.user_id', '=', 'users.id')->whereMonth('penyelesaian_lhp.created_at', $bulan)->get();
        $output = [];

        foreach ($details as $key => $val) {
            $ret[$val['name']][] = $val;
            $output = $ret;
        }

        return $output;
    }

    function dataDumas($bulan){
        $satker = Satker::all();

        if($bulan == null || $bulan == ''){
            $bulan = date('m');
        }

        foreach ($satker as $key => $value) {
            $dumas = Dumas::where('satker_id', $value->id)->whereMonth('created_at', '=', $bulan)->first();
            $value->dumas = $dumas;
        }
        return $satker;
    }

    function dataHukdis($bulan){
        $satker = Satker::all();

        if($bulan == null || $bulan == ''){
            $bulan = date('m');
        }

        foreach ($satker as $key => $value) {
            $hukdis = Hukdis::where('satker_id', $value->id)->whereMonth('created_at', '=', $bulan)->first();
            $value->hukdis = $hukdis;
        }
        return $satker;
    }

    function dataEksternal($bulan){
        $user = User::where('level','ESELON II')->get();
        foreach ($user as $key => $value) {
            $data[$value->name] = TemuanEksternal::where('user_id',$value->id)->whereMonth('created_at', '=', $bulan)->get();
        }
        return $data;
    }

    
    function dataInternal($bulan){
        $user = User::where('level','ESELON II')->get();
        foreach ($user as $key => $value) {
            $data[$value->name] = TemuanInternal::where('user_id',$value->id)->whereMonth('created_at', '=', $bulan)->get();
        }
        return $data;
    }

    function dataRealisasiAnggaran($bulan){
        $jenis_kegiatan = [
            'INSPEKTORAT WILAYAH I',
            'INSPEKTORAT WILAYAH II',
            'INSPEKTORAT WILAYAH III',
            'INSPEKTORAT WILAYAH IV',
            'INSPEKTORAT WILAYAH V',
            'INSPEKTORAT WILAYAH VI',
            'DUKUNGAN MANAJEMEN'
        ];

        foreach ($jenis_kegiatan as $key => $value) {
            $anggaran = JenisAnggaran::where('jenis_kegiatan',$value)->get();
            foreach ($anggaran as $key => $val) {

                $realisasi = 0;
                $detail = RealisasiAnggaran::where('kro_id', $val->id)->whereMonth('created_at', '=', $bulan)->get();
                foreach($detail as $key => $vv){
                    $realisasi =+ $vv->realisasi;
                }
                $val->realisasi = $realisasi;
            }

            $data[$value] = $anggaran;
        }

        return $data;
    }

    function dataKompetensi($bulan){

        $master = Kompetensi::whereMonth('created_at', '=', $bulan)->get();
        return $master;
    }

    function dataSuratMasuk($bulan){

        $eselon = [
            'INSPEKTORAT WILAYAH I',
            'INSPEKTORAT WILAYAH II',
            'INSPEKTORAT WILAYAH III',
            'INSPEKTORAT WILAYAH IV',
            'INSPEKTORAT WILAYAH V',
            'INSPEKTORAT WILAYAH VI',
            'PROGRAM HUBUNGAN MASYARAKAT DAN PELAPORAN',
            'UMUM',
            'SISITEM INFORMASI PENGAWASAN',
            'KEUANGAN',
            'KEPEGAWAIAN'
        ];
        $data = [];

        foreach($eselon as $key => $value){
            $dd = SuratMasuk::where('pelaksana', $value)->whereMonth('created_at', '=', $bulan)->first();
            if(!empty($dd)){
                $data[$value] =$dd->surat;
            }
        }
        return $data;
    }

    // TABLE
    function ikkTable($bulan){
        $data = $this->dataIKK($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));

        foreach ($data as $key => $value) {
            $table->addRow(-0.5, array('exactHeight' => -5));
            $table->addCell(6000)->addText($key);
            $table->addRow();
            $table->addCell(1200,$styleCell)->addText('Sasaran Strategis Kegiatan',$TfontStyle);
            $table->addCell(1200,$styleCell)->addText('Indikator Kinerja Utama',$TfontStyle);
            $table->addCell(800,$styleCell)->addText('Target',$TfontStyle);
            $table->addCell(1200,$styleCell)->addText('Capaian',$TfontStyle);
            $table->addCell(1200,$styleCell)->addText('Analisa Capaian Target',$TfontStyle);
            $table->addCell(1200,$styleCell)->addText('Kegiatan yang Mendukung',$TfontStyle);
            $table->addCell(1000,$styleCell)->addText('Kendala / Hambatan',$TfontStyle);
            foreach ($value as $key => $val) {
                    $i = 0;
                    if(count($val->ikk) > 1){
                        foreach ($val->ikk as $ikk) {
                            $table->addRow();
                            $table->addCell(1200,$styleCell)->addText('SK-'.$val->nomor.'<w:br/> '.str_replace("\r\n","<w:br/>",$val->deskripsi),$TfontStyle);
                            $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$ikk->deskripsi),$TfontStyle);
                            $table->addCell(800,$styleCell)->addText(str_replace("\r\n","<w:br/>",$ikk->target),$TfontStyle);
                            $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$ikk->capaian),$TfontStyle);
                            $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$ikk->analisa),$TfontStyle);
                            $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$ikk->kegiatan),$TfontStyle);
                            $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$ikk->kendala_hambatan),$TfontStyle);
                        }                        
                    }else{
                        $table->addRow();
                        $table->addCell(1200,$styleCell)->addText('SK-'.$val->nomor.'<w:br/> '.str_replace("\r\n","<w:br/>",$val->deskripsi),$TfontStyle);
                        $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$val->ikk[$i]->deskripsi),$TfontStyle);
                        $table->addCell(800,$styleCell)->addText(str_replace("\r\n","<w:br/>",$val->ikk[$i]->target),$TfontStyle);
                        $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$val->ikk[$i]->capaian),$TfontStyle);
                        $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$val->ikk[$i]->analisa),$TfontStyle);
                        $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$val->ikk[$i]->kegiatan),$TfontStyle);
                        $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$val->ikk[$i]->kendala_hambatan),$TfontStyle);
                    }

            }

                // $i = 0;
                // if(count($dd->iku) > 1){
                //     foreach ($dd->iku as $iku) {
                //         $table->addRow();
                //         $table->addCell(1200,$styleCell)->addText('SS-'.$dd->nomor.'<w:br/> '.str_replace("\r\n","<w:br/>",$dd->deskripsi),$TfontStyle);
                //         $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->deskripsi),$TfontStyle);
                //         $table->addCell(800,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->target),$TfontStyle);
                //         $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->capaian),$TfontStyle);
                //         $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->analisa),$TfontStyle);
                //         $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->kegiatan),$TfontStyle);
                //         $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->kendala_hambatan),$TfontStyle);
                //     }
                // }else{
                //     $table->addRow();
                //     $table->addCell(1200,$styleCell)->addText('SS-'.$dd->nomor.'<w:br/> '.str_replace("\r\n","<w:br/>",$dd->deskripsi),$TfontStyle);
                //     $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->deskripsi),$TfontStyle);
                //     $table->addCell(800,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->target),$TfontStyle);
                //     $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->capaian),$TfontStyle);
                //     $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->analisa),$TfontStyle);
                //     $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->kegiatan),$TfontStyle);
                //     $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->kendala_hambatan),$TfontStyle);
                // }
        }


       
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        $fullxml = $objWriter->getWriterPart('Document')->write();
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    function ikuTable($bulan){
        $data = $this->dataIku($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table->addRow(-0.5, array('exactHeight' => -5));

        $table->addCell(1200,$styleCell)->addText('Sasaran Strategis Program',$TfontStyle);
        $table->addCell(1200,$styleCell)->addText('Indikator Kinerja Utama',$TfontStyle);
        $table->addCell(800,$styleCell)->addText('Target',$TfontStyle);
        $table->addCell(1200,$styleCell)->addText('Capaian',$TfontStyle);
        $table->addCell(1200,$styleCell)->addText('Analisa Capaian Target',$TfontStyle);
        $table->addCell(1200,$styleCell)->addText('Kegiatan yang Mendukung',$TfontStyle);
        $table->addCell(1000,$styleCell)->addText('Kendala / Hambatan',$TfontStyle);

        foreach ($data as $dd) {
            $i = 0;

            if(count($dd->iku) > 1){
                foreach ($dd->iku as $iku) {
                    $table->addRow();
                    $table->addCell(1200,$styleCell)->addText('SS-'.$dd->nomor.'<w:br/> '.str_replace("\r\n","<w:br/>",$dd->deskripsi));
                    $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->deskripsi));
                    $table->addCell(800,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->target));
                    $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->capaian));
                    $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->analisa));
                    $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->kegiatan));
                    $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$iku->kendala_hambatan));
                }
            }else{
                $table->addRow();
                $table->addCell(1200,$styleCell)->addText('SS-'.$dd->nomor.'<w:br/> '.str_replace("\r\n","<w:br/>",$dd->deskripsi));
                $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->deskripsi));
                $table->addCell(800,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->target));
                $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->capaian));
                $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->analisa));
                $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->kegiatan));
                $table->addCell(1200,$styleCell)->addText(str_replace("\r\n","<w:br/>",$dd->iku[$i]->kendala_hambatan));
            }
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        $fullxml = $objWriter->getWriterPart('Document')->write();
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    function kegiatanTable($bulan){

        $data = $this->dataKegiatan($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $tableStyle = array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  );
        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $styleJenisCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','gridSpan' => 6,'fillColor' => 'black');
        $stylePelaksanaCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','gridSpan' => 6,);
        $fontStyle = array('italic'=> false, 'size'=>11, 'name'=>'Times New Roman','afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 );
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $jenisFontStyle = array('allCaps'=>true,'bold'=> true, 'size'=>11, 'name' => 'Times New Roman','afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $pelaksanaFontStyle = array('allCaps'=>true,'bold'=> true, 'size'=>11, 'name' => 'Times New Roman','afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $noSpace = array('textBottomSpacing' => -1);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table2 = $section->addTable('myOwnTableStyle');
        $table->addRow(-0.5, array('exactHeight' => -5));

        
        $table->addCell(800,$styleCell)->addText('No',$TfontStyle);
        $table->addCell(2000,$styleCell)->addText('Nama Kegiatan',$TfontStyle);
        $table->addCell(2000,$styleCell)->addText('Nomor/Tgl SP',$TfontStyle);
        $table->addCell(2500,$styleCell)->addText('TMT dan Lokasi Kegiatan',$TfontStyle);
        $table->addCell(2000,$styleCell)->addText('Temuan Utama',$TfontStyle);
        $table->addCell(1000,$styleCell)->addText('Keterangan',$TfontStyle);
        foreach ($data as $jenis => $vv) {
            $table->addRow();
            $table->addCell(1000,$styleJenisCell)->addText($jenis,$jenisFontStyle);
            foreach ($vv as $pelaksana => $val) {
                $table->addRow();
                $table->addCell(1000,$stylePelaksanaCell)->addText($pelaksana,$pelaksanaFontStyle);
                $no = 1;
                foreach ($val as $isi => $value) {
                    $table->addRow();
                    $table->addCell(800,$styleCell)->addText($no);
                    $table->addCell(2000,$styleCell)->addText($value['nama']);
                    $c3 = $table->addCell(2000,$styleCell);
                    $c3->addText('nomor: '.$value['surat_perintah']);
                    $c3->addText('tanggal: '.$value['tanggal_surat_perintah']);
                    $c4 = $table->addCell(2500,$styleCell);
                    $c4->addText($value['tanggal_pelaksanaan']);
                    $c4->addText('lokasi: '.$value['lokasi']);
                    $table->addCell(2000,$styleCell)->addText($value['temuan']);
                    $table->addCell(1000,$styleCell)->addText($value['Keterangan']);
                    $no++;
                }
            }
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        $fullxml = $objWriter->getWriterPart('Document')->write();
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;

    }

    function penyelesaianLHPTable($bulan){

        $data = $this->dataPenyelesaianLHP($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $styleJenisCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','gridSpan' => 4,'fillColor' => 'black');
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $jenisFontStyle = array('allCaps'=>true,'bold'=> true, 'size'=>11, 'name' => 'Times New Roman','afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table->addRow(-0.5, array('exactHeight' => -5));

        
        $table->addCell(800,$styleCell)->addText('No',$TfontStyle);
        $table->addCell(3000,$styleCell)->addText('Nomor/Tgl Surat Perintah',$TfontStyle);
        $table->addCell(3000,$styleCell)->addText('LHP Nomor',$TfontStyle);
        $table->addCell(3000,$styleCell)->addText('Keterangan',$TfontStyle);
        foreach ($data as $jenis => $vv) {
            $table->addRow();
            $table->addCell(1000,$styleJenisCell)->addText($jenis,$jenisFontStyle);
            $no = 1;
            foreach ($vv as $isi => $value) {
                $table->addRow();
                $table->addCell(800,$styleCell)->addText($no);
                $c3 = $table->addCell(3000,$styleCell);
                $c3->addText('nomor: '.$value['nomor_surat_perintah']);
                $c3->addText('tanggal: '.$value['tanggal_surat_perintah']);
                $table->addCell(3000,$styleCell)->addText($value['nomor_lhp']);
                $table->addCell(3000,$styleCell)->addText($value['Keterangan']);
                $no++;
            }
        }
        

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        
        // // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        
        // // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    function kinerjaLainnyaTable($bulan){

        $data = $this->dataKinerjaLainnya($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table->addRow(-0.5, array('exactHeight' => -5));

        
        $table->addCell(1500,$styleCell)->addText('Pelaksana',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('No',$TfontStyle);
        $table->addCell(1000,$styleCell)->addText('Tanggal',$TfontStyle);
        $table->addCell(5000,$styleCell)->addText('Kegiatan',$TfontStyle);
        foreach ($data as $key => $value) {
            if(count($value) > 0){
                $i = 1;
                foreach ($value as $key => $kegiatan) {
                    $table->addRow();
                    $table->addCell(1500,$styleCell)->addText($kegiatan->pelaksana);
                    $table->addCell(500,$styleCell)->addText($i++);
                    $table->addCell(1000,$styleCell)->addText($kegiatan->created_at->format('d F Y'));
                    $table->addCell(5000,$styleCell)->addText($kegiatan->kegiatan);
                }
            }
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        $fullxml = $objWriter->getWriterPart('Document')->write();
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    function dumasTable($bulan){

        $data = $this->dataDumas($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table->addRow(-0.5, array('exactHeight' => -5));

        
        $table->addCell(1500,$styleCell)->addText('Unit',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Berkas Masuk',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Proses Auditor',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Proses Irjen',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Proses Menteri',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Proses Kanwil',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Jumlah Selesai',$TfontStyle);
        foreach ($data as $key => $value) {
            $berkas_masuk =+ !empty($value->dumas->berkas_masuk) ? $value->dumas->berkas_masuk : 0;
            $proses_auditor =+ !empty($value->dumas->proses_auditor) ? $value->dumas->proses_auditor : 0;
            $proses_irjen =+ !empty($value->dumas->proses_irjen) ? $value->dumas->proses_irjen : 0;
            $proses_menteri =+ !empty($value->dumas->proses_menteri) ? $value->dumas->proses_menteri : 0;
            $proses_kanwil =+ !empty($value->dumas->proses_kanwil) ? $value->dumas->proses_kanwil : 0;
            $jumlah_selesai =+ !empty($value->dumas->jumlah_selesai) ? $value->dumas->jumlah_selesai : 0;
            $table->addRow();
            $table->addCell(1000,$styleCell)->addText($value->nama);
            $table->addCell(500,$styleCell)->addText(!empty($value->dumas->berkas_masuk) ? $value->dumas->berkas_masuk : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->dumas->proses_auditor) ? $value->dumas->proses_auditor : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->dumas->proses_irjen) ? $value->dumas->proses_irjen : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->dumas->proses_menteri) ? $value->dumas->proses_menteri : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->dumas->proses_kanwil) ? $value->dumas->proses_kanwil : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->dumas->jumlah_selesai) ? $value->dumas->jumlah_selesai : 0);
        }
        $table->addRow();
        $table->addCell(1000,$styleCell)->addText('Total',$TfontStyle);
        $table->addCell(500,$styleCell)->addText($berkas_masuk,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($proses_auditor,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($proses_irjen,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($proses_menteri,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($proses_kanwil,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($jumlah_selesai,$TfontStyle);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        $fullxml = $objWriter->getWriterPart('Document')->write();
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    function hukdisTable($bulan){

        $data = $this->dataHukdis($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table->addRow(-0.5, array('exactHeight' => -5));

        
        $table->addCell(1500,$styleCell)->addText('Unit',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Berkas Masuk',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Proses Auditor',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Proses Irjen',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Proses Menteri',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Proses Setjen',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('Proses Satker',$TfontStyle);
        $table->addCell(500,$styleCell)->addText('SK Terbit',$TfontStyle);
        foreach ($data as $key => $value) {
            $berkas_masuk =+ !empty($value->hukdis->berkas_masuk) ? $value->hukdis->berkas_masuk : 0;
            $proses_auditor =+ !empty($value->hukdis->proses_auditor) ? $value->hukdis->proses_auditor : 0;
            $proses_irjen =+ !empty($value->hukdis->proses_irjen) ? $value->hukdis->proses_irjen : 0;
            $proses_menteri =+ !empty($value->hukdis->proses_menteri) ? $value->hukdis->proses_menteri : 0;
            $proses_setjen =+ !empty($value->hukdis->proses_setjen) ? $value->hukdis->proses_setjen : 0;
            $proses_satker =+ !empty($value->hukdis->proses_satker) ? $value->hukdis->proses_satker : 0;
            $sk_terbit =+ !empty($value->hukdis->sk_terbit) ? $value->hukdis->sk_terbit : 0;
            $table->addRow();
            $table->addCell(1000,$styleCell)->addText($value->nama);
            $table->addCell(500,$styleCell)->addText(!empty($value->hukdis->berkas_masuk) ? $value->hukdis->berkas_masuk : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->hukdis->proses_auditor) ? $value->hukdis->proses_auditor : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->hukdis->proses_irjen) ? $value->hukdis->proses_irjen : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->hukdis->proses_menteri) ? $value->hukdis->proses_menteri : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->hukdis->proses_setjen) ? $value->hukdis->proses_setjen : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->hukdis->proses_satker) ? $value->hukdis->proses_satker : 0);
            $table->addCell(500,$styleCell)->addText(!empty($value->hukdis->sk_terbit) ? $value->hukdis->sk_terbit : 0);
        }
        $table->addRow();
        $table->addCell(1000,$styleCell)->addText('Total',$TfontStyle);
        $table->addCell(500,$styleCell)->addText($berkas_masuk,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($proses_auditor,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($proses_irjen,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($proses_menteri,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($proses_setjen,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($proses_satker,$TfontStyle);
        $table->addCell(500,$styleCell)->addText($sk_terbit,$TfontStyle);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        $fullxml = $objWriter->getWriterPart('Document')->write();
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    function eksternalTable($bulan){

        $data = $this->dataEksternal($bulan);
        
        $rekomendasi_jumlah = 0;
        $rekomendasi_nominal = 0;
        $sesuai_jumlah = 0;
        $sesuai_nominal = 0;
        $proses_tl_jumlah = 0;
        $proses_tl_nominal = 0;
        $belum_tl_jumlah = 0;
        $belum_tl_nominal = 0;
        $setor_uang_ke_negara = 0;

        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $styleCellColSpan = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','gridSpan' => 2 );
        $styleCellRowSpan = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','vMerge' => 'restart' );
        $cellRowContinue = array('borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','vMerge' => 'continue');
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));

        foreach ($data as $key => $value) {

                $table->addRow(-0.5, array('exactHeight' => -5));
                $table->addCell(null,array('gridSpan'=> 4))->addText($key);
                $table->addRow();
    
                $table->addCell(800,$styleCellRowSpan)->addText('No',$TfontStyle);
                $table->addCell(3000,$styleCellRowSpan)->addText('Objek Pemeriksaan',$TfontStyle);
                $table->addCell(3000,$styleCellColSpan)->addText('Rekomendasi',$TfontStyle);
                $table->addCell(3000,$styleCellColSpan)->addText('Sesuai Dengan Rekomendasi',$TfontStyle);
                $table->addCell(3000,$styleCellColSpan)->addText('Belum Sesuai',$TfontStyle);
                $table->addCell(3000,$styleCellColSpan)->addText('Belum Ditindaklanjuti',$TfontStyle);
                $table->addCell(3000,$styleCellRowSpan)->addText('Nilai Penyerahan Aset',$TfontStyle);
                $table->addRow();
                $table->addCell(null, $cellRowContinue);
                $table->addCell(null, $cellRowContinue);
                $table->addCell(500, $styleCell)->addText('=');
                $table->addCell(2500, $styleCell)->addText('Rp.');
                $table->addCell(500, $styleCell)->addText('=');
                $table->addCell(2500, $styleCell)->addText('Rp.');
                $table->addCell(500, $styleCell)->addText('=');
                $table->addCell(2500, $styleCell)->addText('Rp.');
                $table->addCell(500, $styleCell)->addText('=');
                $table->addCell(2500, $styleCell)->addText('Rp.');
                $table->addCell(null, $cellRowContinue);
    
                $i = 1;
                foreach ($value as $key => $isi) {
                    
                    if(count($value) > 0){

                    $rekomendasi_jumlah =+ $isi->rekomendasi_jumlah != null ? $isi->rekomendasi_jumlah : 0;
                    $rekomendasi_nominal =+ $isi->rekomendasi_nominal != null ? $isi->rekomendasi_nominal : 0;
                    $sesuai_jumlah =+ $isi->sesuai_jumlah != null ? $isi->sesuai_jumlah : 0;
                    $sesuai_nominal =+ $isi->sesuai_nominal != null ? $isi->sesuai_nominal : 0;
                    $proses_tl_jumlah =+ $isi->proses_tl_jumlah != null ? $isi->proses_tl_jumlah : 0;
                    $proses_tl_nominal =+ $isi->proses_tl_nominal != null ? $isi->proses_tl_nominal : 0;
                    $belum_tl_jumlah =+ $isi->belum_tl_jumlah != null ? $isi->belum_tl_jumlah : 0;
                    $belum_tl_nominal =+ $isi->belum_tl_nominal != null ? $isi->belum_tl_nominal : 0;
                    $setor_uang_ke_negara =+ $isi->setor_uang_ke_negara != null ? $isi->setor_uang_ke_negara : 0;

                    $table->addRow();
                    $table->addCell(null, $styleCell)->addText($i++);
                    $table->addCell(null, $styleCell)->addText($isi->tahun.'"<w:br/>"'.$isi->obrik);
                    $table->addCell(500, $styleCell)->addText($isi->rekomendasi_jumlah != null ? $isi->rekomendasi_jumlah : '-');
                    $table->addCell(2500, $styleCell)->addText($isi->rekomendasi_nominal != null ? $isi->rekomendasi_nominal : '-');
                    $table->addCell(500, $styleCell)->addText($isi->sesuai_jumlah != null ? $isi->sesuai_jumlah : '-');
                    $table->addCell(2500, $styleCell)->addText($isi->sesuai_nominal != null ? $isi->sesuai_nominal : '-');
                    $table->addCell(500, $styleCell)->addText($isi->proses_tl_jumlah != null ? $isi->proses_tl_jumlah : '-');
                    $table->addCell(2500, $styleCell)->addText($isi->proses_tl_nominal != null ? $isi->proses_tl_nominal : '-');
                    $table->addCell(500, $styleCell)->addText($isi->belum_tl_jumlah != null ? $isi->belum_tl_jumlah : '-');
                    $table->addCell(2500, $styleCell)->addText($isi->belum_tl_nominal != null ? $isi->belum_tl_nominal : '-');
                    $table->addCell(null, $styleCell)->addText($isi->setor_uang_ke_negara != null ? $isi->setor_uang_ke_negara : '-');
                    }
                }

                $table->addRow();
                $table->addCell(null, $styleCell)->addText();
                $table->addCell(1000,$styleCell)->addText('Total',$TfontStyle);
                $table->addCell(500,$styleCell)->addText($rekomendasi_jumlah,$TfontStyle);
                $table->addCell(500,$styleCell)->addText($rekomendasi_nominal,$TfontStyle);
                $table->addCell(500,$styleCell)->addText($sesuai_jumlah,$TfontStyle);
                $table->addCell(500,$styleCell)->addText($sesuai_nominal,$TfontStyle);
                $table->addCell(500,$styleCell)->addText($proses_tl_jumlah,$TfontStyle);
                $table->addCell(500,$styleCell)->addText($proses_tl_nominal,$TfontStyle);
                $table->addCell(500,$styleCell)->addText($belum_tl_jumlah,$TfontStyle);
                $table->addCell(500,$styleCell)->addText($belum_tl_nominal,$TfontStyle);
                $table->addCell(500,$styleCell)->addText($setor_uang_ke_negara,$TfontStyle);

            }
            
            
        

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        
        // // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        
        // // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    function internalTable($bulan){

        $data = $this->dataInternal($bulan);

        $temuan_jumlah = 0;
        $temuan_nominal =0;
        $sudah_tl_jumlah = 0;
        $sudah_tl_nominal = 0;
        $belum_tl_jumlah =0;
        $belum_tl_nominal = 0;

        // return $data;
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $styleCellColSpan = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','gridSpan' => 6 );
        $styleCellRowSpan = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','vMerge' => 'restart' );
        $cellRowContinue = array('borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','vMerge' => 'continue');
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));

        foreach ($data as $key => $value) {

                $table->addRow(-0.5, array('exactHeight' => -5));
                $table->addCell(null,array('gridSpan'=> 4))->addText($key);
                $table->addRow();
    
                $table->addCell(800,$styleCellRowSpan)->addText('No',$TfontStyle);
                $table->addCell(3000,$styleCellRowSpan)->addText('Unite Eselon I / Kanwil',$TfontStyle);
                $table->addCell(3000,$styleCellColSpan)->addText('Temuan Pemeriksaan',$TfontStyle);
                $table->addRow();
                $table->addCell(null, $cellRowContinue);
                $table->addCell(null, $cellRowContinue);
                $table->addCell(500, $styleCell)->addText('Jumlah Temuan');
                $table->addCell(2500, $styleCell)->addText('Rp.');
                $table->addCell(500, $styleCell)->addText('Sudah TL');
                $table->addCell(2500, $styleCell)->addText('Rp.');
                $table->addCell(500, $styleCell)->addText('Belum TL');
                $table->addCell(2500, $styleCell)->addText('Rp.');
    
                $i = 1;
                foreach ($value as $key => $isi) {
                    if(count($value) > 0){

                    $temuan_jumlah =+ $isi->temuan_jumlah != null ? $isi->temuan_jumlah : 0;
                    $temuan_nominal =+ $isi->temuan_nominal != null ? $isi->temuan_nominal : 0;
                    $sudah_tl_jumlah =+ $isi->sudah_tl_jumlah != null ? $isi->sudah_tl_jumlah : 0;
                    $sudah_tl_nominal =+ $isi->sudah_tl_nominal != null ? $isi->sudah_tl_nominal : 0;
                    $belum_tl_jumlah =+ $isi->belum_tl_jumlah != null ? $isi->belum_tl_jumlah : 0;
                    $belum_tl_nominal =+ $isi->belum_tl_nominal != null ? $isi->belum_tl_nominal : 0;

                    $table->addRow();
                    $table->addCell(null, $styleCell)->addText($i++);
                    $table->addCell(null, $styleCell)->addText($isi->tahun.'<w:br/>'.$isi->obrik);
                    $table->addCell(500, $styleCell)->addText($isi->temuan_jumlah != null ? $isi->temuan_jumlah : '-');
                    $table->addCell(2500, $styleCell)->addText($isi->temuan_nominal != null ? $isi->temuan_nominal : '-');
                    $table->addCell(500, $styleCell)->addText($isi->sudah_tl_jumlah != null ? $isi->sudah_tl_jumlah : '-');
                    $table->addCell(2500, $styleCell)->addText($isi->sudah_tl_nominal != null ? $isi->sudah_tl_nominal : '-');
                    $table->addCell(500, $styleCell)->addText($isi->belum_tl_jumlah != null ? $isi->belum_tl_jumlah : '-');
                    $table->addCell(2500, $styleCell)->addText($isi->belum_tl_nominal != null ? $isi->belum_tl_nominal : '-');
                    }
                }

                $table->addRow();
                $table->addCell(null, $styleCell)->addText($i++);
                $table->addCell(null, $styleCell)->addText('Total',$TfontStyle);
                $table->addCell(null, $styleCell)->addText($temuan_jumlah,$TfontStyle);
                $table->addCell(null, $styleCell)->addText($temuan_nominal,$TfontStyle);
                $table->addCell(null, $styleCell)->addText($sudah_tl_jumlah,$TfontStyle);
                $table->addCell(null, $styleCell)->addText($sudah_tl_nominal,$TfontStyle);
                $table->addCell(null, $styleCell)->addText($belum_tl_jumlah,$TfontStyle);
                $table->addCell(null, $styleCell)->addText($belum_tl_nominal,$TfontStyle);
        }
            
        

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        
        // // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        
        // // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    function realisasiAnggaranTable($bulan){

        $data = $this->dataRealisasiAnggaran($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $styleCellColSpan = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','gridSpan' => 6 );
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $jenisFontStyle = array('allCaps'=>true,'bold'=> true, 'size'=>11, 'name' => 'Times New Roman','afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $pelaksanaFontStyle = array('allCaps'=>true,'bold'=> true, 'size'=>11, 'name' => 'Times New Roman','afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table->addRow(-0.5, array('exactHeight' => -5));

        
        $table->addCell(800,$styleCell)->addText('No',$TfontStyle);
        $table->addCell(2000,$styleCell)->addText('KRO',$TfontStyle);
        $table->addCell(2000,$styleCell)->addText('Pagu',$TfontStyle);
        $table->addCell(2500,$styleCell)->addText('Realisasi',$TfontStyle);
        $table->addCell(2000,$styleCell)->addText('%',$TfontStyle);
        $table->addCell(1000,$styleCell)->addText('Keterangan',$TfontStyle);
        foreach ($data as $jenis_kegiatan => $vv) {
            $table->addRow();
            $table->addCell(null,$styleCellColSpan)->addText($jenis_kegiatan,$pelaksanaFontStyle);
            $no = 1;
            foreach ($vv as $val) {
                $table->addRow();
                $table->addCell(null,$styleCell)->addText($no++);
                $table->addCell(null,$styleCell)->addText($val->nama);
                $table->addCell(null,$styleCell)->addText($val->pagu);
                $table->addCell(null,$styleCell)->addText($val->realisasi);
                $table->addCell(null,$styleCell)->addText(round(($val->realisasi / $val->pagu) * 100, 2) . '%');
                $table->addCell(null,$styleCell)->addText($val->keterangan);
            }
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        $fullxml = $objWriter->getWriterPart('Document')->write();
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;

    }

    function kompetensiTable($bulan){

        $data = $this->dataKompetensi($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table->addRow(-0.5, array('exactHeight' => -5));

        
        $table->addCell(null,$styleCell)->addText('No',$TfontStyle);
        $table->addCell(null,$styleCell)->addText('Nama Kegiatan',$TfontStyle);
        $table->addCell(null,$styleCell)->addText('Jumlah Peserta',$TfontStyle);
        $table->addCell(null,$styleCell)->addText('Jumlah Hari',$TfontStyle);
        $table->addCell(null,$styleCell)->addText('Waktu Penyelenggaraan',$TfontStyle);
        $table->addCell(null,$styleCell)->addText('Nama Peserta',$TfontStyle);
        $i = 1;
        foreach ($data as $key => $kompetensi) {
            $table->addRow();
            $table->addCell(null,$styleCell)->addText($i++);
            $table->addCell(null,$styleCell)->addText($kompetensi->nama);
            $table->addCell(null,$styleCell)->addText($kompetensi->jumlah_peserta);
            $table->addCell(null,$styleCell)->addText($kompetensi->jumlah_hari);
            $table->addCell(null,$styleCell)->addText($kompetensi->waktu_penyelenggaraan);
            $table->addCell(null,$styleCell)->addText(str_replace("\r\n","<w:br/>",$kompetensi->peserta));
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        $fullxml = $objWriter->getWriterPart('Document')->write();
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    function suratMasukTable($bulan){

        $data = $this->dataSuratMasuk($bulan);
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();
        $section = $document_with_table->addSection();
        $table = $section->addTable();

        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $styleBottomCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black','gridSpan' => 2,'fillColor' => 'black');
        $TfontStyle = array('bold'=>true, 'italic'=> false, 'size'=>11, 'name' => 'Times New Roman', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table->addRow(-0.5, array('exactHeight' => -5));

        
        $table->addCell(null,$styleCell)->addText('No',$TfontStyle);
        $table->addCell(null,$styleCell)->addText('Wilayah / Bagian',$TfontStyle);
        $table->addCell(null,$styleCell)->addText('Jumlah',$TfontStyle);
        $i = 1;
        $total = 0;
        foreach ($data as $key => $value) {
            $total =+ $value;
            $table->addRow();
            $table->addCell(null,$styleCell)->addText($i++);
            $table->addCell(null,$styleCell)->addText($key);
            $table->addCell(null,$styleCell)->addText($value);
        }
        $table->addRow();
        $table->addCell(null,$styleBottomCell)->addText('Total',$TfontStyle);
        $table->addCell(null,$styleCell)->addText($total,$TfontStyle);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
        $fullxml = $objWriter->getWriterPart('Document')->write();
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        return $tablexml;
    }

    // END PROSESING
    public function downloadLaporan(Request $request)
    {
        $bulan = $request->input('bulan');
        $bulanString = date('F', mktime(0, 0, 0, $bulan, 10));
        $document_with_table = new \PhpOffice\PhpWord\PhpWord();        
        // // //Open template with ${table}
        $template_document = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app\public\uploads\template_laporan.docx'));
        // COMPONENT
        $iku = $this->ikuTable($bulan);
        $ikk = $this->ikkTable($bulan);
        $kegiatan = $this->kegiatanTable($bulan);
        $penyelesaian_lhp = $this->penyelesaianLHPTable($bulan);
        $kinerja_lainnya = $this->kinerjaLainnyaTable($bulan);
        $dumas = $this->dumasTable($bulan);
        $hukdis = $this->hukdisTable($bulan);
        $eksternal = $this->eksternalTable($bulan);
        $internal = $this->internalTable($bulan);
        $realisasi_anggaran = $this->realisasiAnggaranTable($bulan);
        $kompetensi = $this->kompetensiTable($bulan);
        $surat_masuk = $this->suratMasukTable($bulan);

        // return $internal;
        
        // END COMPONENT

        // SET TABLE
        // // // Replace mark by xml code of table
        $template_document->setValue('bulan', $bulanString);
        $template_document->setValue('kegiatan', $kegiatan);
        $template_document->setValue('penyelesaian_lhp', $penyelesaian_lhp);
        $template_document->setValue('iku', $iku);
        $template_document->setValue('ikk', $ikk);
        $template_document->setValue('kinerja_lainnya', $kinerja_lainnya);
        $template_document->setValue('dumas', $dumas);
        $template_document->setValue('hukdis', $hukdis);
        $template_document->setValue('eksternal', $eksternal);
        $template_document->setValue('internal', $internal);
        $template_document->setValue('realisasi_anggaran', $realisasi_anggaran);
        $template_document->setValue('kompetensi', $kompetensi);
        $template_document->setValue('surat_masuk', $surat_masuk);
        
        // END SET TABLE
        // //save template with table
        $template_document->saveAs(storage_path('app\public\uploads\laporan.docx'));
        return response()->download(storage_path('app\public\uploads\laporan.docx'));
    }
}
