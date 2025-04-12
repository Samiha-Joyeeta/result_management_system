@include('layouts.header')
@include('layouts.topbar-sidebar')


<div class="dashboard-contents">
    @yield('main-section')
</div>

@include('layouts.footer')