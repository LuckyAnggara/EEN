@extends('../layout/' . $layout)

@section('subhead')
    <title>Input - Kegiatan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Input Realisasi Indikator Kegiatan Utama</h2>
    </div>
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
        <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i data-feather="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif
    <div class="grid grid-cols-12 gap-6 mt-5">
        <form action="{{route('store-iku')}}" method="post" class="intro-y col-span-12 lg:col-span-6">
            {{ csrf_field() }}
            <div >
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Tanggal Realisasi</label>
                        <input class="datepicker form-control" name="created_at" data-single-mode="true">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Indikator Kegiatan Utama</label>
                        <select data-placeholder="Indikator Kegiatan Utama" class="tom-select w-full" name="iku" id="iku">
                            @foreach ($iku as $item)
                                <option data-target="{{$item->target}}" value="{{$item->id}}">{{$item->deskripsi}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Target</label>
                        <input id="target" type="text" class="form-control w-full" placeholder="Target Indikator Kinerja Utama" value="{{$iku[0]->target}}" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Capaian</label>
                        <input name="capaian" type="text" class="form-control w-full" placeholder="Capaian">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Analisa Capaian Target</label>
                        <textarea name="analisa" type="text" class="form-control w-full" placeholder="Analisa Capaian Target"></textarea>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Kegiatan Yang Mendukung</label>
                        <textarea name="kegiatan" type="text" class="form-control w-full" placeholder="Kegiatan Yang Mendukung"></textarea>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Kendala / Hambatan</label>
                        <textarea name="kendala_hambatan" type="text" class="form-control w-full" placeholder="Kendala / Hambatan"></textarea>
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
        $('#iku').on('change', function() {
            var target = $(this).find(':selected').data('target');
            $('#target').val(target);
        });
       
    </script>
@endsection
