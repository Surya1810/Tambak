@extends('layouts.admin')

@section('title')
    Buku Kas
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
                    <h1>Buku Kas</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Buku Kas</strong></li>
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
                    <div class="card card-outline rounded-tambak card-orange">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3 class="card-title">Buku Kas</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-vaname rounded-tambak float-right"
                                        data-toggle="modal" data-target="#addSatuan">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="akunTable" class="table table-bordered text-nowrap text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 20%">
                                            No
                                        </th>
                                        <th style="width: 30%">
                                            Nama
                                        </th>
                                        {{-- <th style="width: 30%">
                                            Kredit
                                        </th>
                                        <th style="width: 30%">
                                            Debit
                                        </th> --}}
                                        <th style="width: 20%">
                                            Aktivitas
                                        </th>
                                        <th style="width: 30%">
                                            Jenis
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($akun as $data)
                                        <tr>
                                            <td>{{ $data->nomor }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->aktivitas }}</td>
                                            <td>{{ $data->jenis }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-danger rounded-tambak"
                                                    onclick="deleteAkun({{ $data->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="{{ route('akun.destroy', $data->id) }}" method="POST"
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
        </div>
    </section>
    <!-- Modal Add Data-->
    <div class="modal fade" id="addSatuan" tabindex="-1" aria-labelledby="addSatuanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStepModalLabel">Tambah Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('akun.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="mb-0 form-label col-form-label-sm">Nama Akun</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Masukan nama akun" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="aktivitas">Aktivitas</label>
                            <select class="form-control aktivitas select2-orange is-invalid"
                                data-dropdown-css-class="select2-orange" style="width: 100%;" id="aktivitas"
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
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <select class="form-control jenis select2-orange is-invalid"
                                data-dropdown-css-class="select2-orange" style="width: 100%;" id="jenis" name="jenis">
                                <option></option>
                                <option value="Pendapatan" {{ old('status') == 'Pendapatan' ? 'selected' : '' }}>
                                    Pendapatan</option>
                                <option value="Beban" {{ old('status') == 'Beban' ? 'selected' : '' }}>
                                    Beban</option>
                                <option value="Harta" {{ old('status') == 'Harta' ? 'selected' : '' }}>
                                    Harta</option>
                            </select>
                            @error('jenis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-vaname rounded-tambak">Tambah</button>
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

    <script type="text/javascript">
        $(function() {
            $('#akunTable').DataTable({
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
        });

        function deleteAkun(id) {
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

        $('.aktivitas').select2({
            placeholder: "Select status",
            minimumResultsForSearch: -1,
            allowClear: true,
        })
        $('.jenis').select2({
            placeholder: "Select status",
            minimumResultsForSearch: -1,
            allowClear: true,
        })
    </script>
@endpush
