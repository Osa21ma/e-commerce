@include('user.layouts.head')

    @include('user.layouts.header')

        @include('user.layouts.banner')
        
                @yield('body')
                @include('user.layouts.footer')
