@include('layouts.header')
@include('layouts.topbar-sidebar')


<div class="container content">
    <div class="col">
        <div class="card">
            <div class="card-body">
                 @yield('main-section')
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')