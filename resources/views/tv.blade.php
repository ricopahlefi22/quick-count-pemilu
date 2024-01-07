<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quixx</title>
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @livewireStyles
    @livewireScripts
</head>
<body>

    <header class="header">
        <div class="container mx-auto">
            <span class="brand">Quixx</span>
        </div>
    </header>
    <section class="content">
        {{-- @livewire.show-tv --}}
        @livewire('show-tv')
        @livewire('live-chart')

       
    </section>
    
  

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   

  
    @stack('js')
</body>
</html>