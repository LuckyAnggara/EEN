@extends('../layout/' . $layout)

@section('subhead')
    <title>Daftar - Hukuman Disiplin</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Pengelolaan Daftar Hukuman Disiplin</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a class="btn btn-primary shadow-md mr-2" href="{{ url('input-form-hukdis') }}">Tambah Data</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="intro-y alert alert-success alert-dismissible show flex items-center mb-2 mt-2" role="alert">
        <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i data-feather="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif
    @if (!empty($warning))
    <div class="intro-y alert alert-warning alert-dismissible show flex items-center mb-2 mt-2" role="alert">
        <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{$warning}} <a href="{{ url('input-form-hukdis') }}"><strong>&nbsp<u>Tambah Data</u></strong></a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i data-feather="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form action="{{ route('list-hukdis') }}" method="GET"  id="tabulator-html-filter-form" class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Bulan</label>
                    <select value="{{$params->input('bulan')}}" name="bulan" id="tabulator-html-filter-field" class="form-select w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto">
                    {{-- <option value="0" {{$params->input('bulan') == '0' ?'Selected' : '' }}> Semua Bulan</option> --}}
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
            @if (empty($warning))
            <div class="flex mt-5 sm:mt-0">
                <button class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2">
                    <a href="{{ route('edit-form-hukdis', ['bulan' => $params->input('bulan') == null ? date('m') : $params->input('bulan')]) }}">
                    <i data-feather="edit" class="w-4 h-4 mr-2"></i> Edit
                    </a>
                </button>
                <div class="text-center">
                    <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-preview" class="btn btn-outline-danger w-1/2 sm:w-auto mr-2"><i data-feather="trash" class="w-4 h-4 mr-2"></i> Hapus</a>
                </div>

                <!-- BEGIN: Modal Content -->
                <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="p-5 text-center">
                                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                    <div class="text-3xl mt-5">Anda yakin?</div>
                                    <div class="text-gray-600 mt-2">Data Hukuman Disiplin bulan {{$bulanString}} akan di <strong>Hapus</strong>!</div>
                                </div>
                                <form action="{{ route('delete-hukdis', ['bulan' => $params->input('bulan') == null ? date('m') : $params->input('bulan')])}}" method="post">
                                <div class="px-5 pb-8 text-center">
                                    @method('delete')
                                    @csrf
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Batal</button>
                                    {{-- DELETE BUTTON --}}
                                    <button type="submit" class="btn btn-danger w-24">Hapus</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Modal Content -->
            </div>
            @endif
        </div>
        
                                    
        <div class="overflow-x-auto mt-5">
            <table class="table">
                <thead>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Unit</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Berkas Masuk</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proses Auditor</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proses Irjen</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proses Menteri</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proses Setjen</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proses Satker</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">SK Terbit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{$data->nama}}</td>
                        <td class="border-b dark:border-dark-5">{{!empty($data->hukdis->berkas_masuk) ? $data->hukdis->berkas_masuk : '-' }}</td>
                        <td class="border-b dark:border-dark-5">{{!empty($data->hukdis->proses_auditor) ? $data->hukdis->proses_auditor : '-' }}</td>
                        <td class="border-b dark:border-dark-5">{{!empty($data->hukdis->proses_irjen) ? $data->hukdis->proses_irjen : '-' }}</td>
                        <td class="border-b dark:border-dark-5">{{!empty($data->hukdis->proses_menteri) ? $data->hukdis->proses_menteri : '-' }}</td>
                        <td class="border-b dark:border-dark-5">{{!empty($data->hukdis->proses_setjen) ? $data->hukdis->proses_setjen : '-' }}</td>
                        <td class="border-b dark:border-dark-5">{{!empty($data->hukdis->sk_terbit) ? $data->hukdis->sk_terbit : '-' }}</td>
                        <td class="border-b dark:border-dark-5">{{!empty($data->hukdis->sk_terbit) ? $data->hukdis->sk_terbit : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: HTML Table Data -->
@endsection