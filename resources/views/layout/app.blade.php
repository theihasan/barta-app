@include('include.header')

@if (Auth::check())
    @yield('main-section')
@endif

@include('include.footer')
