@extends('layouts.admin')

@section('title')
    Data Harga
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
                    <h1>Data Harga</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Data Harga</strong></li>
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
                                    <h3 class="card-title">Data Harga</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-primary rounded-tambak float-right"
                                        data-toggle="modal" data-target="#addHarga">
                                        Tambah Harga
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="hargaTable" class="table table-bordered text-nowrap text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 15%">
                                            Size
                                        </th>
                                        <th style="width: 25%">
                                            Harga
                                        </th>
                                        <th style="width: 25%">
                                            Supplier
                                        </th>
                                        <th style="width: 10%">
                                            Dari
                                        </th>
                                        <th style="width: 10%">
                                            Sampai
                                        </th>
                                        <th style="width: 15%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($harga as $data)
                                        <tr>
                                            <td>{{ $data->size }}</td>
                                            <td>{{ formatRupiah($data->harga) }}</td>
                                            <td>{{ $data->supplier->name }}</td>
                                            <td>{{ $data->mulai->isoFormat('DD-MM-YYYY') }} </td>
                                            <td>{{ $data->selesai->isoFormat('DD-MM-YYYY') }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-warning rounded-tambak" type="button"
                                                    data-toggle="modal" data-target="#editHarga{{ $data->id }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger rounded-tambak"
                                                    onclick="deleteHarga({{ $data->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="{{ route('harga.destroy', $data->id) }}" method="POST"
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
    <div class="modal fade" id="addHarga" tabindex="-1" aria-labelledby="addHargaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStepModalLabel">Tambah Harga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('harga.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="size" class="mb-0 form-label col-form-label-sm">Size</label>
                                    <input type="number" class="form-control @error('size') is-invalid @enderror"
                                        id="size" name="size" placeholder="Masukan size"
                                        value="{{ old('size') }}" autocomplete="off" required>
                                    @error('size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="harga" class="mb-0 form-label col-form-label-sm">Harga</label>
                                    <input type="text" class="price form-control @error('harga') is-invalid @enderror"
                                        id="harga" name="harga" placeholder="Masukan harga"
                                        value="{{ old('harga') }}" required>
                                    @error('harga')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="supplier" class="mb-0 form-label col-form-label-sm">Supplier</label>
                                    <select class="form-control supplier select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="supplier"
                                        name="supplier" required>
                                        <option></option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ old('supplier') == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="mulai" class="mb-0 form-label col-form-label-sm">Mulai</label>
                                    <input type="date" class="form-control @error('mulai') is-invalid @enderror"
                                        id="mulai" name="mulai" value="{{ old('mulai') }}" autocomplete="off"
                                        required>
                                    @error('mulai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="mulai" class="mb-0 form-label col-form-label-sm">Selesai</label>
                                    <input type="date" class="form-control @error('selesai') is-invalid @enderror"
                                        id="selesai" name="selesai" value="{{ old('selesai') }}" autocomplete="off"
                                        required>
                                    @error('selesai')
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

    @foreach ($harga as $data)
        <!-- Modal Add Data-->
        <div class="modal fade" id="editHarga{{ $data->id }}" tabindex="-1" aria-labelledby="editHargaLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStepModalLabel">Ubah Harga</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('harga.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="size" class="mb-0 form-label col-form-label-sm">Size</label>
                                        <input type="number" class="form-control @error('size') is-invalid @enderror"
                                            id="size" name="size" placeholder="Masukan size"
                                            value="{{ $data->size }}" autocomplete="off" required>
                                        @error('size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="harga" class="mb-0 form-label col-form-label-sm">Harga Beli</label>
                                        <input type="text"
                                            class="price form-control @error('harga') is-invalid @enderror" id="harga"
                                            name="harga" placeholder="Masukan harga beli" value="{{ $data->harga }}"
                                            required>
                                        @error('harga')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="supplier2" class="mb-0 form-label col-form-label-sm">Supplier</label>
                                        <select class="form-control supplier2 select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;" id="supplier2"
                                            name="supplier2">
                                            <option></option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}"
                                                    {{ $data->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                    {{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('supplier2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="mulai" class="mb-0 form-label col-form-label-sm">Mulai</label>
                                        <input type="date" class="form-control @error('mulai') is-invalid @enderror"
                                            id="mulai" name="mulai" value="{{ $data->mulai }}"
                                            autocomplete="off" required>
                                        @error('mulai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="mulai" class="mb-0 form-label col-form-label-sm">Selesai</label>
                                        <input type="date" class="form-control @error('selesai') is-invalid @enderror"
                                            id="selesai" name="selesai" value="{{ $data->selesai }}"
                                            autocomplete="off" required>
                                        @error('selesai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary rounded-tambak">Ubah</button>
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
            $('#hargaTable').DataTable({
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

        function deleteHarga(id) {
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

        $('.kolam').select2({
            placeholder: "Pilih kolam",
        })

        $(function() {
            $('.price').inputmask({
                alias: 'numeric',
                prefix: 'Rp',
                digits: 0,
                groupSeparator: '.',
                autoGroup: true,
                removeMaskOnSubmit: true,
                rightAlign: false
            });
        })
        $('.supplier').select2({
            placeholder: "Pilih supplier",
        })
        $('.supplier2').select2({
            placeholder: "Pilih supplier",
        })
    </script>
@endpush
