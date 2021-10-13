@extends('../layout/' . $layout)

@section('subhead')
    <title>Indikator Kegiatan Utama</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Indikator Kinerja Utama Inspektorat Jenderal</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a class="btn btn-primary shadow-md mr-2" href="{{ url('input-form-iku') }}">Tambah Realisasi</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show flex items-center mb-2 mt-2" role="alert">
        <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i data-feather="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form action="{{ route('list-iku') }}" method="GET"  id="tabulator-html-filter-form" class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Bulan</label>
                    <select value="{{$params->input('bulan')}}" name="bulan" id="tabulator-html-filter-field" class="form-select w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto">
                        <?php for( $m=1; $m<=12; ++$m ) { 
                        $month_label = date('F', mktime(0, 0, 0, $m, 1));
                        ?>
                    <option value="<?php echo $m;?>" {{$params->input('bulan') == $m ?'Selected' : '' }}><?php echo $month_label; ?></option>
                    <?php } ?>
                    </select>
                </div>
                
                <div class="mt-2 xl:mt-0">
                    <button type="submit" id="tabulator-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16" >Submit</button>
                </div>
            </form>
            {{-- <div class="flex mt-5 sm:mt-0">
                <button id="tabulator-print" class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2">
                    <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                </button>
                <div class="dropdown w-1/2 sm:w-auto">
                    <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false">
                        <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export <i data-feather="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i>
                    </button>
                    <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                            <a id="tabulator-export-csv" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export XLSX
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        
                                    
        <div class="overflow-x-auto mt-5">
            <table class="table">
                <thead>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Sasaran Strategis</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Indikator Kinerja Utama</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Target</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Capaian</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Analisa Capaian Target</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Kegiatan yang mendukung</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Kendala / Hambatan</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                        @if (count($data->iku) > 1)
                        <tr>
                            <td class="border-b dark:border-dark-5" rowspan="{{count($data->iku) + 1}}" >SS-{{ $data->nomor }}<br><p class="text-justify">{{$data->deskripsi}}</p></td> 
                        </tr>
                        @foreach($data->iku as $iku)
                            <tr>
                                <td class="border-b dark:border-dark-5">{{$iku->deskripsi}}</td>
                                <td class="border-b dark:border-dark-5">{{$iku->target}}</td>
                                <td class="border-b dark:border-dark-5">{{$iku->capaian}}</td>
                                <td class="border-b dark:border-dark-5">{{$iku->analisa}}</td>
                                <td class="border-b dark:border-dark-5"><pre>{{$iku->kegiatan}}</pre></td>
                                <td class="border-b dark:border-dark-5">{{$iku->kendala_hambatan}}</td>
                                @if ($iku->capaian_id != '')
                                <td class="border-b dark:border-dark-5">
                                    <div class="box mt-5">
                                    {{-- <a class="btn btn-sm btn-warning mr-1 mb-2" href="javascript:;">
                                        <i data-feather="edit" class="w-3 h-3"></i>
                                    </a> --}}
                                    <a class="btn btn-sm  btn-danger mr-1 mb-2" href="{{ url('iku/'.$iku->capaian_id.'/delete') }}">
                                        <i data-feather="trash" class="w-3 h-3"></i>
                                    </a>
                                    </div>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="border-b dark:border-dark-5">SS-{{ $data->nomor }}<br><p class="text-justify">{{$data->deskripsi}}</p></td>
                            <td class="border-b dark:border-dark-5">{{$data->iku[0]->deskripsi}}</td>
                            <td class="border-b dark:border-dark-5">{{$data->iku[0]->target}}</td>
                            <td class="border-b dark:border-dark-5">{{$data->iku[0]->capaian}}</td>
                            <td class="border-b dark:border-dark-5">{{$data->iku[0]->analisa}}</td>
                            <td class="border-b dark:border-dark-5"><pre>{{$data->iku[0]->kegiatan}}</pre></td>
                            <td class="border-b dark:border-dark-5">{{$data->iku[0]->kendala_hambatan}}</td>
                            @if ($data->iku[0]->capaian_id != '')
                            <td class="border-b dark:border-dark-5">
                                <div class="box mt-5">
                                {{-- <a class="btn btn-sm btn-warning mr-1 mb-2" href="javascript:;">
                                    <i data-feather="edit" class="w-3 h-3"></i>
                                </a> --}}
                                <a class="btn btn-sm  btn-danger mr-1 mb-2" href="{{ url('iku/'.$data->iku[0]->id.'/delete') }}">
                                    <i data-feather="trash" class="w-3 h-3"></i>
                                </a>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endif
                       

                        {{-- <td class="border-b dark:border-dark-5">{{$data->nama}}</td>
                        <td class="border-b dark:border-dark-5">{{$data->surat_perintah}} Tanggal {{$data->tanggal_surat_perintah->format('d F Y')}}</td>
                        <td class="border-b dark:border-dark-5">{{$data->tanggal_pelaksanaan}} <br> lokasi: {{$data->lokasi}} </td>
                        <td class="border-b dark:border-dark-5"><pre>{{($data->temuan)}}</pre></td>
                        <td class="border-b dark:border-dark-5">{{$data->keterangan}}</td> --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: HTML Table Data -->
@endsection