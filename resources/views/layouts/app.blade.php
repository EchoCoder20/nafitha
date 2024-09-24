<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{asset('photo/logo-white.png')}}"/>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net"> -->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/css/aboutus.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/css/chat.css')}}"> 
        <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">

        <!-- Scripts -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>
    <body>
        <header>
            @include('layouts.navigation')
        </header>
            <!-- Page Heading -->
            <!-- @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif -->

            <!-- Page Content -->
           
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
<script src="{{asset('assets/js/script.js')}}"></script>

</body>
</html>

    
    
    
    
