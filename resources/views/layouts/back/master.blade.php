<!doctype html>
<html>
@include('includes.back.head')
<body>

<section id="container" class="">


        @include('includes.back.header')

        @include('includes.back.sidebar')

        @yield('content')


        @include('includes.back.footer')
</section>
@include('includes.back.script')
@yield('script_js')
</body>
</html>

