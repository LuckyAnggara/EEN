@extends('../layout/' . $layout)

@section('subhead')
    <title>Daftar - Kegiatan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Daftar Kegiatan {{$user->name}}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a class="btn btn-primary shadow-md mr-2" href="{{ url('input-form-kegiatan') }}">Tambah Kegiatan</a>
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
            <form action="{{ route('list-kegiatan') }}" method="GET"  id="tabulator-html-filter-form" class="xl:flex sm:mr-auto" >
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
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Cari Data</label>
                    <input name="cari" value="{{$params->input('cari')}}" id="tabulator-html-filter-value" type="text" class="form-control sm:w-80 xxl:w-full mt-2 sm:mt-0" placeholder="Search...">
                </div>
                <div class="mt-2 xl:mt-0">
                    <button type="submit" id="tabulator-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16" >Submit</button>
                </div>
            </form>
        </div>
        
                                    
        <div class="overflow-x-auto mt-5">
            <table class="table">
                <thead>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Tanggal</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nama Kegiatan</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Surat Perintah</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Tanggal Perintah & Lokasi</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Temuan Utama</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Keterangan</th>
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
                        <td class="border-b dark:border-dark-5">{{$data->created_at->format('d F Y') }}</td>
                        <td class="border-b dark:border-dark-5">{{$data->nama}}</td>
                        <td class="border-b dark:border-dark-5">{{$data->surat_perintah}} Tanggal {{$data->tanggal_surat_perintah->format('d F Y')}}</td>
                        <td class="border-b dark:border-dark-5">{{$data->tanggal_pelaksanaan}} <br> lokasi: {{$data->lokasi}} </td>
                        <td class="border-b dark:border-dark-5"><pre>{{($data->temuan)}}</pre></td>
                        <td class="border-b dark:border-dark-5">{{$data->keterangan}}</td>
                        <td class="border-b dark:border-dark-5">
                            <div class="box mt-5">
                            {{-- <a class="btn btn-sm btn-warning mr-1 mb-2" href="javascript:;">
                                <i data-feather="edit" class="w-3 h-3"></i>
                            </a> --}}
                            <a class="btn btn-sm  btn-danger mr-1 mb-2" href="{{ url('kegiatan/'.$data->id.'/delete') }}">
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