@extends('../layout/' . $layout)

@section('subhead')
    <title>Daftar - Realisasi Anggaran</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Realisasi Anggaran Inspektorat Jenderal</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a class="btn btn-primary shadow-md mr-2" href="{{ url('input-form-realisasi-anggaran') }}">Tambah Data</a>
        </div>
    </div>
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form action="{{ route('list-realisasi-anggaran') }}" method="GET"  id="tabulator-html-filter-form" class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Bulan</label>
                    <select value="{{$params->input('bulan')}}" name="bulan" id="tabulator-html-filter-field" class="form-select w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto">
                        <?php for( $m=1; $m<=12; ++$m ) { 
                        $month_label = date('F', mktime(0, 0, 0, $m, 1));
                        $selected = $params->input('bulan');
                        if($params->input('bulan') == null){
                            $selected = date('m');
                        }
                        ?>
                    <option value="<?php echo $m;?>" {{$selected == $m ?'Selected' : '' }}><?php echo $month_label; ?></option>
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
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Bulan</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Jenis Kegiatan</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Klasifikasi Rincian Output</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Pagu</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Realisasi</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Sisa</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($data as $data)
                    
                    <tr>
                        <td class="border-b dark:border-dark-5">{{$i++}}</td>
                        <td class="border-b dark:border-dark-5">{{$data->created_at->format('F') }}</td>
                        <td class="border-b dark:border-dark-5">{{$data->jenis_kegiatan}}</td>
                        <td class="border-b dark:border-dark-5">{{$data->nama}}</td>
                        <td class="border-b dark:border-dark-5">Rp. {{ number_format($data->pagu)}}</td>
                        <td class="border-b dark:border-dark-5">Rp. {{ number_format($data->realisasi)}} <span class="text-red-700 "> (<?php echo round($data->realisasi/$data->pagu * 100,1) ;?>%)</span></td>
                        <td class="border-b dark:border-dark-5">Rp. {{ number_format($data->sisa)}} <span class="text-red-300 ">(<?php echo round($data->sisa/$data->pagu * 100,1) ;?>%)</span></td>
                        <td class="border-b dark:border-dark-5">
                            <div class="box mt-5">
                            {{-- <a class="btn btn-sm btn-warning mr-1 mb-2" href="javascript:;">
                                <i data-feather="edit" class="w-3 h-3"></i>
                            </a> --}}
                            <a class="btn btn-sm  btn-danger mr-1 mb-2" href="{{ url('realisasi-anggaran/'.$data->realisasi_id.'/delete') }}">
                                <i data-feather="trash" class="w-3 h-3"></i>
                            </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" colspan="4">Total</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Rp. {{ number_format($total_pagu)}}</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Rp. {{ number_format($total_realisasi)}}</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Rp. {{ number_format($total_sisa)}}</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- END: HTML Table Data -->
@endsection