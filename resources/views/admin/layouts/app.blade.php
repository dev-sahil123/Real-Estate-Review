<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.layouts.partials.head')
    </head>
    <body class="theme-light" style="overflow-y: auto;">
        <div id="app">
            @include('admin.layouts.partials.sidebar')
            <div id="main">
                 @include('admin.layouts.partials.header')

                 @yield('content')

                @include('admin.layouts.partials.footer')
            </div>   
        </div>
        @include('admin.layouts.partials.modals')

        @include('admin.layouts.partials.scripts')
    </body>
</html>