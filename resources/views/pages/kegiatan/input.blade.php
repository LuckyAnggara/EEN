@extends('../layout/' . $layout)

@section('subhead')
    <title>Input - Kegiatan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Input Kegiatan</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <form action="{{route('store-kegiatan')}}" method="post" class="intro-y col-span-12 lg:col-span-6">
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
                        <textarea name="nama" type="text" class="form-control w-full"  placeholder="Nama Kegiatan"></textarea>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Jenis Kegiatan</label>
                        <select data-placeholder="Jenis Kegiatan" class="tom-select w-full" name="jenis">
                            <option value="AUDIT" selected>AUDIT</option>
                            <option value="REVIU">REVIU</option>
                            <option value="EVALUASI">EVALUASI</option>
                            <option value="PEMANTAUAN">PEMANTAUAN</option>
                            <option value="PENGAWASAN LAINNYA">PENGAWASAN LAINNYA</option>
                            <option value="PEMERIKSAAN KHUSUS">PEMERIKSAAN KHUSUS</option>
                            <option value="DUKUNGAN MANAJEMEN">DUKUNGAN MANAJEMEN</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Pelaksana Kegiatan</label>
                        <input name="pelaksana" type="text" class="form-control w-full" placeholder="Surat Perintah dan Tanggal" readonly value="{{$user->name}}">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Nomor Surat Perintah</label>
                        <input name="surat_perintah" type="text" class="form-control w-full"  placeholder="Nomor Surat Perintah">
                    </div>
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Tanggal Surat Perintah</label>
                        <input class="datepicker form-control" name="tanggal_surat_perintah" data-single-mode="true">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Lokasi Kegiatan</label>
                        <input name="lokasi" type="text" class="form-control w-full"  placeholder="Lokasi Kegiatan">
                    </div>
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Tanggal Pelaksanaan</label>
                        <input class="datepicker form-control" name="tanggal_pelaksanaan" data-daterange="true">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Temuan Utama</label>
                        <textarea name="temuan" type="text" class="form-control w-full"  placeholder="Temuan Utama"></textarea>
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
