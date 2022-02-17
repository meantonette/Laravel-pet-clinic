<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<header class="flex justify-between items-center px-10 py-6 text-white bg-gray-800">
    <div class="text-2xl">
        <h1>Pet Clinic</h1>
    </div>
    <nav>
        <ul class="tracking-widest text-2xl">
            <button> <a href="{{ URL('dashboard') }}">
                    <h5>Home</h5>
                </a></button>
            <button> <a href="{{ URL('animals') }}">
                    <h5>Animals</h5>
                </a></button>
            <button><a href="{{ URL('owner') }}">
                    <h5>Owners</h5>
                </a></button>
            <button><a href={{ URL('employee') }}>
                    <h5>Employee</h5>
                </a></button>
            <button><a href="{{ URL('service') }}">
                    <h5>Service</h5>
                </a></button>
            <button><a href="{{ URL('consultation') }}">
                    <h5>Consultation</h5>
                </a></button>
        </ul>
    </nav>
</header>
<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)), url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    @yield('contents')
</body>
</html>