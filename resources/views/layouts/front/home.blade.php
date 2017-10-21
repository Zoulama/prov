<!doctype html>
<html>
@include('includes.front.head')

    <body>

        @include('includes.front.header')

         @include('includes.front.slider')

             @yield('content')

         @include('includes.front.script')

        @include('includes.front.footer')


    </body>
</html>

