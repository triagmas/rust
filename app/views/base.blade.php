<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Администрирование</title>

    <!-- CSS BootStrap -->
    {{ Bootstrapper\Helpers::get_CSS() }}


    <!-- Core CSS - Include with every page -->
    <script src="{{ Asset::url('singlecss-main') }}"></script> 

</head>

<body>

    <div class="container">
         @yield('container') 
    </div>
 TEST
    <!-- Core Scripts - Include with every page -->
    {{ Bootstrapper\Helpers::get_JS() }}

    <!-- Core Scripts - Include with every page -->
    <script src="{{ Asset::url('singlejs-main') }}"></script>

</body>

</html>
