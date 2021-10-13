@extends('../layout/' . $layout)

@section('subhead')
    <title>Daftar - Kegiatan</title>
@endsection

@section('subcontent')
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
    <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{$message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <i data-feather="x" class="w-4 h-4"></i>
    </button>
</div>
@endif
<form action="{{route('store-dumas')}}" method="post" class="intro-y col-span-12 lg:col-span-6">
    {{ csrf_field() }}
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Input Realisasi</h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <button class="btn btn-primary shadow-md mr-2" type="submit">Submit</button>
    </div>
</div>
<div class="cols-12 gap-12 mt-5">

    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="sm:flex items-center sm:mr-4">
            <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Bulan</label>
            <select name="created_at" id="tabulator-html-filter-field" class="form-select w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto">
            {{-- <option value="0" {{$params->input('bulan') == '0' ?'Selected' : '' }}> Semua Bulan</option> --}}
                <?php for( $m=1; $m<=12; ++$m ) { 
                $month_label = date('F', mktime(0, 0, 0, $m, 1));
                ?>
            <option value="<?php echo $m;?>" {{date('m') == $m ? 'Selected' : ''}}><?php echo $month_label; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">                                    
        <div class="overflow-x-auto mt-5">
            <table class="table">
                <thead>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Unit</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Berkas Masuk</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proses Auditor</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proses Irjen</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proses Menteri</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proses Kanwil</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Jumlah Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                    <tr>
                        <td name="id_{{$data->id}}" class="border-b dark:border-dark-5">{{$data->nama}}</td>
                        <td class="border-b dark:border-dark-5">
                            <input name="berkas_masuk_{{$data->id}}" type="number" class="form-control sm:mt-0" value="0">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="proses_auditor_{{$data->id}}" type="number" class="form-control sm:mt-0" value="0">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="proses_irjen_{{$data->id}}" type="number" class="form-control sm:mt-0" value="0">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="proses_menteri_{{$data->id}}" type="number" class="form-control sm:mt-0" value="0">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="proses_kanwil_{{$data->id}}" type="number" class="form-control sm:mt-0" value="0">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="jumlah_selesai_{{$data->id}}" type="number" class="form-control sm:mt-0" value="0">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>

    <!-- END: HTML Table Data -->
@endsection