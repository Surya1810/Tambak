@extends('layouts.admin')

@section('title')
    Penerimaan Piutang
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
                    <h1>Penerimaan Piutang</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Penerimaan Piutang</strong></li>
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
                                    <h3 class="card-title">Penerimaan Piutang</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-primary rounded-tambak float-right"
                                        data-toggle="modal" data-target="#addPiutang">
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="piutangTable" class="table table-bordered text-nowrap text-center text-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 15%">
                                            Nomor
                                        </th>
                                        <th style="width: 15%">
                                            Customer
                                        </th>
                                        <th style="width: 10%">
                                            Jumlah
                                        </th>
                                        <th style="width: 10%">
                                            Retur
                                        </th>
                                        <th style="width: 10%">
                                            Bayar
                                        </th>
                                        <th style="width: 10%">
                                            Jatuh Tempo
                                        </th>
                                        <th style="width: 20%" class="text-wrap">
                                            Keterangan
                                        </th>
                                        <th style="width: 15%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($piutang as $data)
                                        <tr>
                                            <td>{{ $data->nomor }}</td>
                                            <td>{{ $data->customer->name }}</td>
                                            <td>{{ formatRupiah($data->jumlah) }}</td>
                                            <td>{{ formatRupiah($data->retur) }}</td>
                                            <td>{{ formatRupiah($data->bayar) }}</td>
                                            <td>{{ $data->tanggal->addDays($data->customer->tempo)->format('d/m/Y') }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-success rounded-tambak"
                                                    data-toggle="modal" data-target="#bayarPiutang{{ $data->id }}">
                                                    Bayar
                                                </button>
                                                <button type="button" class="btn btn-sm btn-warning rounded-tambak"
                                                    data-toggle="modal" data-target="#editPiutang{{ $data->id }}">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger rounded-tambak"
                                                    onclick="deletePiutang({{ $data->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="{{ route('piutang.destroy', $data->id) }}" method="POST"
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
    <div class="modal fade" id="addPiutang" tabindex="-1" aria-labelledby="addPiutangLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStepModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('piutang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
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
                                    <label for="customer" class="mb-0 form-label col-form-label-sm">Customer</label>
                                    <select class="form-control customer select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="customer"
                                        name="customer" required>
                                        <option></option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ old('customer') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan" class="mb-0 form-label col-form-label-sm">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3"
                                        placeholder="Tulis keterangan" id="keterangan" name="keterangan" required>{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jumlah" class="mb-0 form-label col-form-label-sm">Jumlah</label>
                                    <input type="text" class="price form-control @error('jumlah') is-invalid @enderror"
                                        id="jumlah" name="jumlah" placeholder="Masukan jumlah piutang"
                                        value="{{ old('jumlah') }}" required>
                                    @error('jumlah')
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

    @foreach ($piutang as $data)
        <!-- Modal Bayar-->
        <div class="modal fade" id="bayarPiutang{{ $data->id }}" tabindex="-1" aria-labelledby="bayarPiutangLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStepModalLabel">Bayar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('piutang.bayar', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="akun" class="mb-0 form-label col-form-label-sm">Akun</label>
                                        <select class="form-control select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;" id="akun"
                                            name="akun" disabled>
                                            <option>{{ $data->akun->nomor }} - {{ $data->akun->nama }}</option>
                                        </select>
                                        @error('akun')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="customer" class="mb-0 form-label col-form-label-sm">Customer</label>
                                        <select class="form-control select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;" id="customer"
                                            name="customer" disabled>
                                            <option>{{ $customer->name }}</option>
                                        </select>
                                        @error('customer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan"
                                            class="mb-0 form-label col-form-label-sm">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" id="keterangan"
                                            name="keterangan" disabled>{{ $data->keterangan }}</textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="jumlah" class="mb-0 form-label col-form-label-sm">Jumlah</label>
                                        <input type="text"
                                            class="price form-control @error('jumlah') is-invalid @enderror"
                                            id="jumlah" name="jumlah" value="{{ $data->jumlah }}" disabled>
                                        @error('jumlah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="bayar" class="mb-0 form-label col-form-label-sm">Nominal
                                            Bayar</label>
                                        <input type="text"
                                            class="price form-control @error('bayar') is-invalid @enderror" id="bayar"
                                            name="bayar" placeholder="Masukan nominal bayar"
                                            value="{{ old('bayar') }}" required>
                                        @error('bayar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tanggal" class="mb-0 form-label col-form-label-sm">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" value="{{ $data->tanggal->format('Y-m-d') }}"
                                            autocomplete="off" disabled>
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary rounded-tambak">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Data-->
        <div class="modal fade" id="editPiutang{{ $data->id }}" tabindex="-1" aria-labelledby="editPiutangLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStepModalLabel">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('piutang.update', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tanggal" class="mb-0 form-label col-form-label-sm">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" placeholder="Pilih Tanggal"
                                            value="{{ $data->tanggal->format('Y-m-d') }}" autocomplete="off" required>
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="keterangan"
                                            class="mb-0 form-label col-form-label-sm">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3"
                                            placeholder="Tulis keterangan" id="keterangan" name="keterangan" required>{{ $data->keterangan }}</textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="jumlah" class="mb-0 form-label col-form-label-sm">Jumlah</label>
                                        <input type="text"
                                            class="price form-control @error('jumlah') is-invalid @enderror"
                                            id="jumlah" name="jumlah" placeholder="Masukan jumlah piutang"
                                            value="{{ $data->jumlah }}" required>
                                        @error('jumlah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="retur" class="mb-0 form-label col-form-label-sm">Retur</label>
                                        <input type="text"
                                            class="price form-control @error('retur') is-invalid @enderror"
                                            id="retur" name="retur" placeholder="Masukan nominal retur"
                                            value="{{ old('retur') }}" required>
                                        @error('retur')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary rounded-tambak">Ubat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
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
            $('#piutangTable').DataTable({
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

        function deletePiutang(id) {
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
            placeholder: "Pilih akun",
            minimumResultsForSearch: -1,
            allowClear: true,
        })
        $('.customer').select2({
            placeholder: "Pilih customer",
            minimumResultsForSearch: -1,
            allowClear: true,
        })
    </script>
@endpush
