@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard - Administrator</title>
@endsection

@section('subcontent')
<div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
    <div class="intro-x flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Progress Input Data</h2>
    </div>
    <div class="col-span-12 grid grid-cols-12 gap-6 mt-3">
        @foreach ($user as $user)
        <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
            <div class="box p-5 zoom-in">
                <div class="flex items-center">
                    <div class="w-2/4 flex-none">
                        <div class="text-lg font-medium truncate">{{ $user->name }}</div>
                    </div>
                </div>
                <div class="progress h-4 rounded mt-3">
                    <div class="progress-bar w-3/4 bg-theme-1 rounded" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">70%</div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
