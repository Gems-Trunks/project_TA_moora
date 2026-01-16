@include('layouts.header')
@auth
    @if (Auth::user()->role == 'admin')
        @include('layouts.sidebar')
    @else
        @include('layouts.sidebar_user')
    @endif
@endauth

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">@yield('judul')</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a
                                href="@if (Auth::user()->role == 'admin') {{ route('admin.dashboard') }} @else {{ route('jemaat.dashboard') }} @endif">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('judul')</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            @yield('konten')
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->
@include('layouts.footer')
