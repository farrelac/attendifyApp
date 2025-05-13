@extends('layouts.main')

@section('content')
    <div class="container-fluid my-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                    <h4 class="mb-0">Detail Absensi</h4>
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button" onclick="copyLink()" class="btn btn-warning btn-sm">
                            <i class="bi bi-clipboard-fill"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                <path
                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                <path
                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                            </svg>
                            Copy Link
                        </button>
                        <a href="{{ route('presence-detail.export-Pdf', $presence->id) }}" target="_blank"
                            class="btn btn-danger btn-sm">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                            </svg>
                            Export to PDF
                        </a>
                        <a href="{{ route('presence.index') }}" class="btn btn-secondary btn-sm">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive mb-4">
                    <table class="table table-borderless w-auto">
                        <tr>
                            <td class="fw-semibold" style="min-width: 150px;">Nama Kegiatan</td>
                            <td>:</td>
                            <td>{{ $presence->nama_kegiatan }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Tanggal Kegiatan</td>
                            <td>:</td>
                            <td>{{ date('d F Y', strtotime($presence->tgl_kegiatan)) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Waktu Mulai</td>
                            <td>:</td>
                            <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>
                        </tr>
                    </table>
                </div>

                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-striped table-bordered w-100'], true) }}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        function copyLink() {
            navigator.clipboard.writeText("{{ route('absen.index', $presence->slug) }}");
            alert('Link berhasil dicopy ke clipboard!');
        }
    </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');

            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    success: function(data) {
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
@endpush
