@extends('../layout/' . $layout)

@section('subhead')
    <title>Daftar - Hukuman Disiplin</title>
@endsection

@section('subcontent')
<form action="{{ route('update-hukdis') }}" method="post" >  
    {{ csrf_field() }}
    <input name="bulan"  type="hidden" value="{{$bulan}}"/>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Edit Pengelolaan Daftar Hukuman Disiplin Bulan {{$bulanString}}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2" type="submit">Update Data</button>
        </div>
    </div>
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible show flex items-center mb-2 mt-2" role="alert">
        <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i data-feather="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">                                    
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
                        <input name="id[]{{$data->id}}"  type="hidden" value="{{$data->id}}"/>
                        <td class="border-b dark:border-dark-5">{{$data->nama_unit}}</td>
                        <td class="border-b dark:border-dark-5">
                            <input name="berkas_masuk[{{$data->id}}]" type="text" class="form-control sm:mt-0" value="{{$data->berkas_masuk}}">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="proses_auditor[{{$data->id}}]" type="text" class="form-control sm:mt-0" value="{{$data->proses_auditor}}">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="proses_irjen[{{$data->id}}]" type="text" class="form-control sm:mt-0" value="{{$data->proses_irjen}}">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="proses_menteri[{{$data->id}}]" type="text" class="form-control sm:mt-0" value="{{$data->proses_menteri}}">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="proses_setjen[{{$data->id}}]" type="text" class="form-control sm:mt-0" value="{{$data->proses_setjen}}">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="proses_satker[{{$data->id}}]" type="text" class="form-control sm:mt-0" value="{{$data->proses_satker}}">
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <input name="sk_terbit[{{$data->id}}]" type="text" class="form-control sm:mt-0" value="{{$data->sk_terbit}}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: HTML Table Data -->
</form>
@endsection