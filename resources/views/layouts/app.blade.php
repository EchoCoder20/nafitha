<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('photo/logo-white.png')}}"/>
    <!-- <title>الصفحة الرئيسية</title> -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    
       

    </head>
    <body>
        <header>
            @include('layouts.navigation')
        </header>
                      
    <div>
     
        @yield('content')
    </div>
   
        @include('layouts.footer')
         
    
        <script>
       let A1 = document.getElementById('A1');
let A2 = document.getElementById('A2');
let A3 = document.getElementById('A3');
let prim = document.getElementById('prim');
let best = document.getElementById('best');
let murshid = document.getElementById('murshid');

murshid.addEventListener('mousemove', function(e) {
    let rect = murshid.getBoundingClientRect();
    
    let mouseX = e.clientX - rect.left;
    let mouseY = e.clientY - rect.top;

    let moveX = (mouseX - rect.width / 2) * 0.02; 
    let moveY = (mouseY - rect.height / 2) * 0.02; 

    murshid.style.transform = `translate(${moveX}px, ${moveY}px)`;
});

murshid.addEventListener('mouseleave', function() {
    murshid.style.transform = 'translate(0, 0)';
});

window.addEventListener('scroll', function(){
    let value = window.scrollY;

    A1.style.position = 'relative';
    A2.style.position = 'relative';
    A3.style.position = 'relative';

    A1.style.left = value * 0.3 + 'px';
    A2.style.left = value * 0.2 + 'px';
    A3.style.left = value * 0.1 + 'px';

    
});

    </script>
        <script src=" {{asset('assets/js/script.js')}}"></script>


</body>
</html>

    
    
    
    
