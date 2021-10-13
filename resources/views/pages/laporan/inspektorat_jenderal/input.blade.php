@extends('../layout/' . $layout)

@section('subhead')
    <title>Laporan Bulanan - Inspektorat Jenderal</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Laporan Bulanan</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div class="mt-3">
                    <label for="crud-form-2" class="form-label">Upload Template Laporan</label>          
                    <form id="upload-form" action="/upload-template-laporan" method="post" enctype="multipart/form-data">
                    {{-- <form id="upload-form"> --}}
                        @csrf
                        <div class="mt-3">
                            <input name="file" type="file" id="file" class="intro-x upload__input form-control py-3 px-4 border-gray-300 block" />
                            {{-- <div id="error-upload" class="upload__input-error w-5/6 text-theme-6 mt-2"></div> --}}
                        </div>
                        <div class="text-right mt-5">
                            <button type="submit" id="btn-upload" class="btn btn-primary w-24">Upload</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- END: Form Layout -->
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            @if($file > 0)

            <div class="intro-y box p-5">
                <div class="mt-3">
                    <div id="error-email" class="login__input-error w-5/6 text-theme-6 mt-2">Template sudah di upload</div>
                </div>
                <form action="/download-laporan" method="get">
                <div class="mt-3">
                    <label for="crud-form-2" class="form-label">Bulan Data</label>          
                    <select name="bulan" id="tabulator-html-filter-field" class="form-select w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto">
                        <?php for( $m=1; $m<=12; ++$m ) { 
                        $month_label = date('F', mktime(0, 0, 0, $m, 1));
                        ?>
                    <option value="<?php echo $m;?>"><?php echo $month_label; ?></option>
                    <?php } ?>
                    </select>    
                </div>
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary w-24">Download</button>
                </div>
                </form>
            </div>
            @endif

            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

{{-- @section('script')
    <script>
        cash(function () {
            async function upload() {
                // Reset state
                cash('#upload-form').find('.upload__input').removeClass('border-theme-6')
                cash('#upload-form').find('.upload__input-error').html('')

                // Post form
                let data = new FormData();
                data.append('file', document.getElementById('file').files[0]);
                data.append('file2', 'aww');
                
                // Loading state
                cash('#btn-upload').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
                // await helper.delay(1500)

                axios.post(`upload-template-laporan`, data).then(res => {
                    console.info(res)
                }).catch(err => {
                    cash('#btn-upload').html('Login')
                    if (err.response.data.message != 'The given') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            cash(`#${key}`).addClass('border-theme-6')
                            cash(`#error-${key}`).html(val)
                        }
                    }
                    // } else {
                    //     cash(`#password`).addClass('border-theme-6')
                    //     cash(`#error-password`).html(err.response.data.message)
                    // }
                })
            }

            // cash('#upload-form').on('keyup', function(e) {
            //     if (e.keyCode === 13) {
            //         upload()
            //     }
            // })
            
            cash('#btn-upload').on('click', function() {
                upload()
            })
        })
    </script>
@endsection --}}
