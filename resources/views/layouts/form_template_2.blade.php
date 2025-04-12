@include('layouts.header')
@include('layouts.topbar-sidebar')

<div class="container content pt-5">
    <div class="card justify-content-center" style="width: 70rem;">
        <div class="card-body">
            <div class="g-4 p-5">
                @yield('main-section')
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')