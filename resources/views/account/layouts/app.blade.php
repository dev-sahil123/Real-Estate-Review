<!DOCTYPE html>
<html lang="en">
    <head>
        @include('account.layouts.partials.head')
    </head>
    <body>
        @include('account.layouts.partials.header')
        <div id="dashboard" class="container">
            @yield('content')
        </div>

        @include('account.layouts.partials.footer')

        @include('account.layouts.partials.modals')

        @include('account.layouts.partials.scripts')
    </body>
</html>