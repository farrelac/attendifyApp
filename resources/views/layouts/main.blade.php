<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Enhanced Title with Dynamic Page Names -->
        <title>
            {{ env('APP_NAME') }}
        </title>

        {{-- CSRF TOKEN --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicon for Attendance System --}}
        <link rel="icon" href="{{ asset('images/attendance-icon.png') }}" type="image/png">

        {{-- SEO Meta Tags --}}
        <meta name="description"
            content="Sistem presensi online untuk manajemen kehadiran seminar, workshop, dan kegiatan akademik">
        <meta name="keywords" content="absensi digital, presensi online, manajemen kehadiran, sistem absensi">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.css">
        <!-- Font Awesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            :root {
                --primary-color: #3498db;
                --secondary-color: #2c3e50;
                --gradient-start: #74ebd5;
                --gradient-end: #ACB6E5;
            }

            body {
                background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
                min-height: 100vh;
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .card {
                background-color: rgba(255, 255, 255, 0.95);
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            .navbar {
                background-color: rgba(255, 255, 255, 0.9) !important;
                backdrop-filter: blur(5px);
            }

            .navbar-brand {
                font-weight: 600;
                color: var(--secondary-color) !important;
                display: flex;
                align-items: center;
            }

            .navbar-brand::before {
                content: "\f073";
                /* Font Awesome calendar icon */
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                margin-right: 10px;
                color: var(--primary-color);
            }
        </style>
    </head>

    <body>

        <nav class="navbar shadow-sm navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ env('APP_NAME', 'Sistem Absensi') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('presence.index') }}">Daftar Absensi</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle me-1"></i>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container py-4">
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.3.0/js/dataTables.bootstrap5.js"></script>

        @stack('js')
    </body>

</html>
