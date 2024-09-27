<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.layouts.partials.head')
    </head>
    <body style="overflow:auto;">
        @include('frontend.layouts.partials.header')

        @yield('content')

        @include('frontend.layouts.partials.footer')
        
        @include('frontend.layouts.partials.modals')

        @include('frontend.layouts.partials.scripts')
    </body>
</html>
