@extends('../layout/' . $layout)

@section('subhead')
    <title>Input - Jumlah Surat Masuk</title>
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
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Input Jumlah Surat Masuk</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <form action="{{route('store-surat-masuk')}}" method="post" class="intro-y col-span-12 lg:col-span-6">
            {{ csrf_field() }}
            <div >
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
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
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Jumlah Surat Masuk</label>
                        <input name="surat" type="number" class="form-control w-full"  placeholder="Nama Surat Masuk" />
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
