@extends('../layout/' . $layout)

@section('subhead')
    <title>Input - TL Temuan Eksternal</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Input Tindak Lanjut Temuan Eksternal</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <form action="{{route('store-temuan-eksternal')}}" method="post" class="intro-y col-span-12 lg:col-span-6">
            {{ csrf_field() }}
            <div >
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Objek Pemeriksaan</label>
                        <input name="obrik" type="text" class="form-control w-full"  placeholder="Nama Objek Pemeriksaan" required>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Tahun Pemeriksanaan</label>
                        <input name="tahun" type="number" class="form-control w-full"  placeholder="Tahun Pemeriksaan" required>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Rekomendasi</label>
                        <div class="sm:grid grid-cols-2 gap-2">
                            <div class="input-group">
                                <div class="input-group-text">Jumlah</div>
                                <input type="number" name="rekomendasi_jumlah" class="form-control" placeholder="Jumlah Temuan">
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <div class="input-group-text">Nominal</div>
                                <input type="number" name="rekomendasi_nominal" class="form-control" placeholder="Nominal Temuan">
                            </div>
                        </div>
                    </div>   
                    <div class="mt-3">
                        <label class="form-label">Sesuai Dengan Rekomendasi</label>
                        <div class="sm:grid grid-cols-2 gap-2">
                            <div class="input-group">
                                <div class="input-group-text">Jumlah</div>
                                <input type="number" name="sesuai_jumlah" class="form-control" placeholder="Jumlah Temuan">
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <div class="input-group-text">Nominal</div>
                                <input type="number" name="sesuai_nominal" class="form-control" placeholder="Nominal Temuan">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Belum Sesuai / Dalam Proses Tindak Lanjut</label>
                        <div class="sm:grid grid-cols-2 gap-2">
                            <div class="input-group">
                                <div class="input-group-text">Jumlah</div>
                                <input type="number" name="proses_tl_jumlah" class="form-control" placeholder="Jumlah Temuan">
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <div class="input-group-text">Nominal</div>
                                <input type="number" name="proses_tl_nominal" class="form-control" placeholder="Nominal Temuan">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Belum di Tindak Lanjuti</label>
                        <div class="sm:grid grid-cols-2 gap-2">
                            <div class="input-group">
                                <div class="input-group-text">Jumlah</div>
                                <input type="number" name="belum_tl_jumlah" class="form-control" placeholder="Jumlah Temuan">
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <div class="input-group-text">Nominal</div>
                                <input type="number" name="belum_tl_nominal" class="form-control" placeholder="Nominal Temuan">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Nilai Penyerahan Aset / Penyetoran Uang ke Negara</label>
                        <input name="setor_uang_ke_negara" type="number" class="form-control w-full"  placeholder="Nilai Penyerahan Aset / Penyetoran Uang ke Negara">
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
