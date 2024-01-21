@extends('layouts.admin')

@section('title')
    Jurnal Umum
@endsection

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jurnal Umum</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Jurnal Umum</strong></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline rounded-tambak card-primary">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3 class="card-title">Jurnal Umum</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-primary rounded-tambak float-right"
                                        data-toggle="modal" data-target="#addJurnal">
                                        Tambah Jurnal
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="jurnalTable" class="table table-bordered text-nowrap text-center text-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 15%">
                                            Akun
                                        </th>
                                        <th style="width: 25%">
                                            Debit
                                        </th>
                                        <th style="width: 25%">
                                            Kredit
                                        </th>
                                        <th style="width: 25%">
                                            Keterangan
                                        </th>
                                        <th style="width: 10%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jurnal as $data)
                                        <tr>
                                            <td>{{ $data->akun->nama }} - {{ $data->akun->nomor }}</td>
                                            <td>
                                                @if ($data->aktivitas == 'Debit')
                                                    {{ formatRupiah($data->nominal) }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->aktivitas == 'Kredit')
                                                    {{ formatRupiah($data->nominal) }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td>
                                                {{ $data->keterangan }}
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-danger rounded-tambak"
                                                    onclick="deleteJurnal({{ $data->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="{{ route('jurnal.destroy', $data->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h4>{{ formatRupiah($debit) }}</h4>

                            <p>Debit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h4>{{ formatRupiah($kredit) }}</h4>

                            <p>Kredit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Add Data-->
    <div class="modal fade" id="addJurnal" tabindex="-1" aria-labelledby="addJurnalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStepModalLabel">Tambah Jurnal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jurnal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="akun" class="mb-0 form-label col-form-label-sm">Akun</label>
                                    <select class="form-control akun select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="akun"
                                        name="akun" required>
                                        <option></option>
                                        @foreach ($akuns as $akun)
                                            <option value="{{ $akun->id }}"
                                                {{ old('akun') == $akun->id ? 'selected' : '' }}>
                                                {{ $akun->nama }} - {{ $akun->nomor }}</option>
                                        @endforeach
                                    </select>
                                    @error('akun')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan" class="mb-0 form-label col-form-label-sm">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Tulis keterangan"
                                        id="keterangan" name="keterangan" required>{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nominal" class="mb-0 form-label col-form-label-sm">Nominal</label>
                                    <input type="text"
                                        class="price form-control @error('nominal') is-invalid @enderror" id="nominal"
                                        name="nominal" placeholder="Masukan nominal transaksi"
                                        value="{{ old('nominal') }}" required>
                                    @error('nominal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggal" class="mb-0 form-label col-form-label-sm">Tanggal</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                        id="tanggal" name="tanggal" placeholder="Pilih Tanggal"
                                        value="{{ old('tanggal') }}" autocomplete="off" required>
                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="aktivitas" class="mb-0 form-label col-form-label-sm">Aktivitas</label>
                                    <select class="form-control aktivitas select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="aktivitas"
                                        name="aktivitas">
                                        <option></option>
                                        <option value="Kredit" {{ old('status') == 'Kredit' ? 'selected' : '' }}>
                                            Kredit</option>
                                        <option value="Debit" {{ old('status') == 'Debit' ? 'selected' : '' }}>
                                            Debit</option>
                                    </select>
                                    @error('aktivitas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-tambak">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/adminLTE/plugins/jszip/jszip.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/adminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/adminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script> --}}
    <script src="{{ asset('assets/adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('assets/adminLTE/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <script type="text/javascript">
        $(function() {
            $('#jurnalTable').DataTable({
                "paging": true,
                'processing': true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                // "scrollX": true,
                // width: "700px",
                // columnDefs: [{
                //     className: 'dtr-control',
                //     orderable: false,
                //     targets: -8
                // }]
            });

            $('.price').inputmask({
                alias: 'numeric',
                prefix: 'Rp',
                digits: 0,
                groupSeparator: '.',
                autoGroup: true,
                removeMaskOnSubmit: true,
                rightAlign: false
            });
        });

        function deleteJurnal(id) {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe !',
                        'error'
                    )
                }
            })
        }

        $('.akun').select2({
            placeholder: "Pilih Akun",
            minimumResultsForSearch: -1,
            allowClear: true,
        })
        $('.aktivitas').select2({
            placeholder: "Pilih Jenis Transaksi",
            minimumResultsForSearch: -1,
            allowClear: true,
        })
    </script>
@endpush
