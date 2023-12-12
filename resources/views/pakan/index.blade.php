@extends('layouts.admin')

@section('title')
    Data Pakan
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
                    <h1>Data Pakan</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Data Pakan</strong></li>
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
                                    <h3 class="card-title">Data Pakan</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-primary rounded-tambak float-right"
                                        data-toggle="modal" data-target="#addPakan">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="pakanTable" class="table table-bordered text-nowrap text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 10%">
                                            Kolam
                                        </th>
                                        <th style="width: 20%">
                                            Tanggal
                                        </th>
                                        <th style="width: 20%">
                                            Waktu
                                        </th>
                                        <th style="width: 20%">
                                            Jumlah
                                        </th>
                                        <th style="width: 20%">
                                            Catatan
                                        </th>
                                        <th style="width: 10%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pakan as $data)
                                        <tr>
                                            <td>{{ $data->kolam()->name }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>{{ $data->waktu }}</td>
                                            <td>{{ $data->jenis }}</td>
                                            <td>{{ $data->jumlah }}Kg</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-warning rounded-tambak"
                                                    href="{{ route('pakan.edit', $data->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger rounded-tambak"
                                                    onclick="deletePakan({{ $data->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="{{ route('pakan.destroy', $data->id) }}" method="POST"
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
    <div class="modal fade" id="addPakan" tabindex="-1" aria-labelledby="addPakanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStepModalLabel">Tambah Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pakan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="kolam" class="mb-0 form-label col-form-label-sm">Kolam</label>
                                    <select class="form-control kolam select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="kolam"
                                        name="kolam">
                                        <option></option>
                                        {{-- @foreach ($kolams as $kolam)
                                                <option value="{{ $kolam->name }}"
                                                    {{ old('kolam') == $kolam->name ? 'selected' : '' }}>{{ $tambak->name }} - 
                                                    {{ $kolam->name }}</option>
                                            @endforeach --}}
                                    </select>
                                    @error('kolam')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal" class="mb-0 form-label col-form-label-sm">Tanggal</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                        id="tanggal" name="tanggal" placeholder="Pilih Tanggal"
                                        value="{{ old('tanggal') }}" autocomplete="off">
                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 col-lg-6">
                                <div class="form-group">
                                    <label for="Waktu" class="mb-0 form-label col-form-label-sm">Waktu</label>
                                    <input type="time" class="form-control @error('Waktu') is-invalid @enderror"
                                        id="Waktu" name="Waktu" placeholder="Masukan alamat tambak"
                                        value="{{ old('Waktu') }}" autocomplete="off">
                                    @error('Waktu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-8 col-lg-8">
                                <div class="form-group">
                                    <label for="pakan" class="mb-0 form-label col-form-label-sm">Jenis Pakan</label>
                                    <select class="form-control pakan select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="pakan"
                                        name="pakan">
                                        <option></option>
                                        {{-- @foreach ($kolams as $kolam)
                                                <option value="{{ $kolam->name }}"
                                                    {{ old('kolam') == $kolam->name ? 'selected' : '' }}>
                                                    {{ $kolam->name }}</option>
                                            @endforeach --}}
                                    </select>
                                    @error('pakan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 col-lg-4">
                                <div class="form-group">
                                    <label for="jumlah" class="mb-0 form-label col-form-label-sm">Jumlah (kg)</label>
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                        id="jumlah" name="jumlah" placeholder="Masukan jumlah pakan"
                                        value="{{ old('jumlah') }}" autocomplete="off">
                                    @error('jumlah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="catatan" class="mb-0 form-label col-form-label-sm">Catatan</label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" rows="3"
                                        placeholder="Tulis catatan bila ada..." id="catatan" name="catatan">{{ old('catatan') }}</textarea>
                                    @error('catatan')
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

    <script type="text/javascript">
        $(function() {
            $('#pakanTable').DataTable({
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

        function deletePakan(id) {
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
    </script>
@endpush
