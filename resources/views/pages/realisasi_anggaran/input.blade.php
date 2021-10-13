@extends('../layout/' . $layout)

@section('subhead')
    <title>Input - Kegiatan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Input Realisasi</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <form action="{{route('store-realisasi-anggaran')}}" method="post" class="intro-y col-span-12 lg:col-span-6">
            {{ csrf_field() }}
            <div >
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Tanggal</label>
                        <input name="created_at" class="datepicker form-control" data-single-mode="true">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Klasifikasi Rincian Output</label>
                        <select name="kro_id" id="kro_id" data-placeholder="Nama KRO" class="form-select w-full" name="jenis" required>
                            @foreach ($data as $item => $value)
                                <option disabled><strong><u>{{$item}}</u></strong></option>
                                <hr>
                                @foreach ($value as $item)
                                     <option value="{{$item->id}}" data-value={{$item->pagu}} >- {{$item->nama}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Pagu Anggaran</label>
                        <input name="pagu" id="pagu" type="number" class="form-control w-full" placeholder="Pagu Anggaran" required readonly>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Realisasi Anggaran</label>
                        <input name="realisasi" id="realisasi" type="number" class="form-control w-full" placeholder="Realisasi Anggaran" required>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Sisa Anggaran</label>
                        <input name="sisa" id="sisa" type="number" class="form-control w-full border-theme-12" placeholder="Sisa Anggaran" required>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('#kro_id').on('change', function() {
            var pagu_value = $(this).find(':selected').data('value');
            if(pagu_value == 0){
                $('#pagu').attr('readonly', false);
            }else{
                $('#pagu').attr('readonly', true);
            }
            $('#pagu').val(pagu_value);
        });
        $('#realisasi').on('keyup', function() {
            var pagu_value = $('#pagu').val();
            var realisasi_value = $('#realisasi').val();
            var sisa = parseFloat(pagu_value) - parseFloat(realisasi_value)
            $('#sisa').val(sisa);
        });
    </script>
@endsection
