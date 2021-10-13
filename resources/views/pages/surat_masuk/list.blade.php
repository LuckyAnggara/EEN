@extends('../layout/' . $layout)

@section('subhead')
    <title>Daftar - Jumlah Surat Masuk</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Daftar Jumlah Surat Masuk</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a class="btn btn-primary shadow-md mr-2" href="{{ url('input-form-surat-masuk') }}">Tambah Data</a>
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
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
        </div>                    
        <div class="overflow-x-auto mt-5">
            <table class="table">
                <thead>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Bulan</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Jumlah</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;   
                    @endphp
                    @foreach($data as $key => $vv)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{$i++}}</td>
                        <td class="border-b dark:border-dark-5">{{$vv->bulan }}</td>
                        <td class="border-b dark:border-dark-5">{{$vv->surat}} Surat</td>
                        <td class="border-b dark:border-dark-5">
                            <div class="box mt-5">
                            {{-- <a class="btn btn-sm btn-warning mr-1 mb-2" href="javascript:;">
                                <i data-feather="edit" class="w-3 h-3"></i>
                            </a> --}}
                            <a class="btn btn-sm  btn-danger mr-1 mb-2" href="{{ url('surat-masuk/'.$vv->id.'/delete') }}">
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