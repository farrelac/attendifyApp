<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.css">
        <style>
            body {
                background: linear-gradient(to bottom right, #c2f0f7, #d4d4f7);
                min-height: 100vh;
            }

            .signature-pad {
                border: 1px solid #000;
                border-radius: 4px;
                width: 100%;
                height: 150px;
            }

            .form-control.mb-2 {
                padding: 0.5rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table.dataTable {
                min-width: 600px;
            }
        </style>

    </head>

    <body>
        <div class="container-fluid my-4 px-3">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="text-center mb-4">{{ env('APP_NAME') }}</h4>
                    <div class="table-responsive">
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
                </div>
            </div>

            <div class="row gy-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Form Absensi</h5>
                        </div>
                        <div class="card-body">
                            <form id="form-absen" action="{{ route('absen.save', $presence->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan">
                                    @error('jabatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="asal_instansi" class="form-label">Asal Instansi</label>
                                    <input type="text" class="form-control" id="asal_instansi" name="asal_instansi">
                                    @error('asal_instansi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanda Tangan</label>
                                    <div class="form-control p-2 mb-2">
                                        <canvas id="signature-pad" class="signature-pad"></canvas>
                                    </div>
                                    <textarea name="signature" id="signature64" class="d-none"></textarea>
                                    @error('signature')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <button type="button" id="clear" class="btn btn-sm btn-secondary">
                                        <i class="bi bi-trash-fill"></i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                        Clear
                                    </button>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Daftar Kehadiran</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {{ $dataTable->table(['class' => 'table table-bordered table-striped w-100']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/signature.min.js') }}"></script>

        <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.3.0/js/dataTables.bootstrap5.js"></script>

        <script>
            $(function() {
                // Set signature pad width
                let sig = $('#signature-pad').parent().width();
                $('#signature-pad').attr('width', sig);

                // Set canvas color
                let signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                    backgroundColor: 'rgb(255, 255, 255, 0)',
                    penColor: 'rgb(0, 0, 0)'
                });

                // Set signature to textarea
                $('canvas').on('mouseup touchend', function() {
                    $('#signature64').val(signaturePad.toDataURL());
                });

                // Clear Signature
                $('#clear').on('click', function(e) {
                    e.preventDefault();
                    signaturePad.clear();
                    $('#signature64').val('');
                });

                $('#form-absen').on('submit', function() {
                    $(this).find('button[type="submit"]').attr('disabled', 'disabled');
                });
            });
        </script>

        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    </body>

</html>
