@extends('../layout/' . $layout)

@section('subhead')
    <title>Input - Kegiatan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Edit Realisasi Pengaduan Masyarakat Pada {{$data->nama_unit}}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <form action="{{route('update-dumas')}}" method="post" class="intro-y col-span-12 lg:col-span-6">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$data->id}}" readonly>
            <div >
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Bulan Data</label>
                        <input class="form-control w-full" type="text" name="bulan" value="{{$data->created_at->format('F')}}" readonly>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Nama Unit</label>
                        <input class="form-control w-full" type="text" name="nama_unit" value="{{$data->nama_unit}}" readonly>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Berkas Masuk</label>
                        <input class="form-control w-full" type="text" name="berkas_masuk" value="{{$data->berkas_masuk}}">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Proses Auditor</label>
                        <input class="form-control w-full" type="text" name="proses_auditor" value="{{$data->proses_auditor}}">
                    </div>
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Proses Inspektur Jenderal</label>
                        <input class="form-control w-full" type="text" name="proses_irjen" value="{{$data->proses_irjen}}">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Proses Menteri</label>
                        <input class="form-control w-full" type="text" name="proses_menteri" value="{{$data->proses_menteri}}">
                    </div>
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Proses Kantor Wilayah</label>
                        <input class="form-control w-full" type="text" name="proses_kanwil" value="{{$data->proses_kanwil}}">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Jumlah Selesai</label>
                        <input class="form-control w-full" type="text" name="jumlah_selesai" value="{{$data->jumlah_selesai}}">
                    </div>
                    <div class="text-right mt-5">
                        <button type="cancel" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-primary w-24">Update</button>
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
        </form>
    </div>
@endsection
