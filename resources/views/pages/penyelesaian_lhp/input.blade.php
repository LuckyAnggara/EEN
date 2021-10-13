@extends('../layout/' . $layout)

@section('subhead')
    <title>Input - Penyelesaian Laporan Hasil Pengawasan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Input Penyelesaian Laporan Hasil Pengawasan</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <form action="{{route('store-penyelesaian-lhp')}}" method="post" class="intro-y col-span-12 lg:col-span-6">
            {{ csrf_field() }}
            <div >
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Nomor Surat Perintah</label>
                        <input name="nomor_surat_perintah" type="text" class="form-control w-full"  placeholder="Nomor Surat Perintah">
                    </div>
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Tanggal Surat Perintah</label>
                        <input class="datepicker form-control" name="tanggal_surat_perintah" data-single-mode="true">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Nomor Laporan Hasil Pengawasan</label>
                        <input name="nomor_lhp" type="text" class="form-control w-full"  placeholder="Nomor Laporan Hasil Pengawasan">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Keterangan</label>
                        <textarea name="keterangan" type="text" class="form-control w-full"  placeholder="Keterangan"></textarea>
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
