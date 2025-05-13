@extends('layouts.main')

@section('content')
    <style>
        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: rgba(0, 123, 255, 0.9);
            color: white;
            font-weight: bold;
            border-radius: 10px 10px 0 0 !important;
        }

        /* Responsive image replacement */
        .illustration-img {
            display: none;
            /* Hide the img element */
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .background-container {
                background-attachment: scroll;
                /* Better performance on mobile */
                padding: 1rem 0;
            }

            .card {
                margin: 0 10px;
            }
        }
    </style>

    <div class="background-container">
        <div class="container mt-2">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="alert alert-info" role="alert">
                                Anda telah berhasil login!
                            </div>

                            <div class="mt-4">
                                <!-- Hidden on desktop (shown in background) -->
                                <img src="https://img.freepik.com/free-vector/time-management-concept-illustration_114360-28802.jpg"
                                    alt="Attendance Illustration"
                                    style="width: 100%; max-width: 500px; height: 300px; object-fit: contain;"
                                    class="illustration-img img-fluid d-block mx-auto mb-3">

                                <p style="text-align: justify;">
                                    Selamat datang di <strong>Attendify</strong>, platform profesional untuk manajemen
                                    kehadiran acara digital. Kami menyederhanakan pencatatan kehadiran untuk berbagai
                                    kegiatan seperti seminar dan lokakarya. Percayakan kebutuhan absensi acara
                                    Anda pada solusi terpercaya, <strong>Attendify</strong>.
                                </p>

                                <a href="{{ route('presence.index') }}" class="btn btn-primary mt-3">
                                    Mulai Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
