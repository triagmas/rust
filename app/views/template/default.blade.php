<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Администрирование</title>

    <!-- CSS BootStrap -->
    {{ Bootstrapper\Helpers::get_CSS() }}

    <!-- Core CSS - Include with every page -->
    {{ HTML::style(Asset::url('singlecss-main')) }} 

</head>

<body>

    <div class="container">
         @yield('container') 
    </div>

    <!-- Core Scripts - Include with every page -->
    {{ Bootstrapper\Helpers::get_JS() }}

    <!-- Core Scripts - Include with every page -->
    {{ HTML::script(Asset::url('singlejs-main')) }}

</body>

</html>

