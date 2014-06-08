<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <title>Start Bootstrap - SB Admin Version 2.0 Demo</title>

    <!-- CSS BootStrap -->
    {{ Bootstrapper\Helpers::get_CSS() }}
    {{ Bootstrapper\Helpers::get_JS() }}

    <!-- Core CSS - Include with every page -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    {{ stylesheet_link_tag() }} 

</head>

<body>

    <div class="container">
         @yeld('container') 
    </div>

    <!-- Core Scripts - Include with every page -->
    {{ Bootstrapper\Helpers::get_JS() }}

    <!-- SB Admin Scripts - Include with every page -->
    {{ javascript_include_tag() }}

</body>

</html>
