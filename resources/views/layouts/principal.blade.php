<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"> 
    <title>
        SisMOS
    </title> 
    
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
    <BODY>
        @yield('menu')
    
        <main>        
            @yield('content')

            @yield('info')
        </main>
        
        @yield('pie')

    </body>
</html>