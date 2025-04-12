@include('layouts.header')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card position-absolute" style="width: 30rem;">
            <div class="card-body">
                @yield('main-section')
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')