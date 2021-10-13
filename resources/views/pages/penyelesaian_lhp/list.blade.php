@extends('../layout/' . $layout)

@section('subhead')
    <title>Daftar - Penyelesaian Laporan Hasil Pengawasan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Daftar Penyelesaian Laporan Hasil Pengawasan {{$user->name}}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a class="btn btn-primary shadow-md mr-2" href="{{ url('input-form-penyelesaian-lhp') }}">Tambah Data</a>
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
            <form action="{{ route('list-penyelesaian-lhp') }}" method="GET"  id="tabulator-html-filter-form" class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Bulan</label>
                    <select value="{{$params->input('bulan')}}" name="bulan" id="tabulator-html-filter-field" class="form-select w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto">
                    <option value="0" {{$params->input('bulan') == '0' ?'Selected' : '' }}> Semua Bulan</option>
                        <?php for( $m=1; $m<=12; ++$m ) { 
                        $month_label = date('F', mktime(0, 0, 0, $m, 1));
                        ?>
                    <option value="<?php echo $m;?>" {{$params->input('bulan') == $m ?'Selected' : '' }}><?php echo $month_label; ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto mr-2">Cari Data</label>
                    <input name="cari" value="{{$params->input('cari')}}" id="tabulator-html-filter-value" type="text" class="form-control sm:w-80 xxl:w-full mt-2 sm:mt-0" placeholder="Search...">
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
                            <a id="tabulator-export-json" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export JSON
                            </a>
                            <a id="tabulator-export-xlsx" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export XLSX
                            </a>
                            <a id="tabulator-export-html" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export HTML
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
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nomor Surat Perintah</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nomor LHP</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Keterangan</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                    <tr>
                        <td class="border-b dark:border-dark-5">1</td>
                        <td class="border-b dark:border-dark-5">No : {{$data->nomor_surat_perintah}} <br> Tanggal : {{$data->tanggal_surat_perintah->format('d F Y')}}</td>
                        <td class="border-b dark:border-dark-5">{{$data->nomor_lhp}}</td>
                        <td class="border-b dark:border-dark-5">{{$data->keterangan}}</td>
                        <td class="border-b dark:border-dark-5">
                            <div class="box mt-5">
                            {{-- <a class="btn btn-sm btn-warning mr-1 mb-2" href="javascript:;">
                                <i data-feather="edit" class="w-3 h-3"></i>
                            </a> --}}
                            <a class="btn btn-sm  btn-danger mr-1 mb-2" href="{{ url('penyelesaian-lhp/'.$data->id.'/delete') }}">
                                <i data-feather="trash" class="w-3 h-3"></i>
                            </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: HTML Table Data -->
@endsection