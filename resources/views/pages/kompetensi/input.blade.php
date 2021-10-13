@extends('../layout/' . $layout)

@section('subhead')
    <title>Input - Kegiatan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Input Kegiatan</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <form action="{{route('store-kompetensi')}}" method="post" class="intro-y col-span-12 lg:col-span-6">
            {{ csrf_field() }}
            <div >
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Tanggal Kegiatan</label>
                        <input class="datepicker form-control" name="created_at" data-single-mode="true">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Nama Kegiatan</label>
                        <input name="nama" type="text" class="form-control w-full"  placeholder="Nama Kegiatan">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Jumlah Peserta</label>
                        <input name="jumlah_peserta" type="number" class="form-control w-full"  placeholder="Jumlah Peserta">
                    </div>
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Waktu Penyelenggaraan</label>
                        <input class="datepicker form-control" name="waktu_penyelenggaraan" data-daterange="true">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Jumlah Hari</label>
                        <input name="jumlah_hari" type="number" class="form-control w-full"  placeholder="Jumlah Hari">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Nama Peserta</label>
                        <textarea name="peserta" type="text" class="form-control w-full"  placeholder="Nama Peserta"></textarea>
                    </div>

                   
                    <div class="text-right mt-5">
                        <button type="cancel" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-primary w-24">Submit</button>
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
        </form>
    </div>
@endsection
