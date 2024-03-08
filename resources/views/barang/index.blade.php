@extends('layouts.admin')

@section('title')
    Barang
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
                    <h1>Barang</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Barang</strong></li>
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
                                    <h3 class="card-title">Barang</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-primary rounded-tambak float-right"
                                        data-toggle="modal" data-target="#addBarang">
                                        Tambah Barang
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="barangTable" class="table table-bordered text-nowrap text-center text-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 10%">
                                            Kode
                                        </th>
                                        <th style="width: 10%">
                                            Kategori
                                        </th>
                                        <th style="width: 20%">
                                            Nama
                                        </th>
                                        <th style="width: 15%">
                                            Supplier
                                        </th>
                                        <th style="width: 15%">
                                            Harga beli
                                        </th>
                                        <th style="width: 10%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $data)
                                        <tr>
                                            <td>{{ $data->code }}</td>
                                            <td>{{ $data->kategori->name }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                @if ($data->supplier_id == null)
                                                    -
                                                @else
                                                    {{ $data->supplier->name }}
                                                @endif
                                            </td>
                                            <td>{{ formatRupiah($data->harga) }}/{{ $data->satuan->name }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-warning rounded-tambak" type="button"
                                                    data-toggle="modal" data-target="#editBarang{{ $data->id }}"><i
                                                        class="fas fa-pen"></i></button>
                                                <button class="btn btn-sm btn-danger rounded-tambak"
                                                    onclick="deleteAkun({{ $data->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="{{ route('barang.destroy', $data->id) }}" method="POST"
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
    <div class="modal fade" id="addBarang" tabindex="-1" aria-labelledby="addBarangLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStepModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="mb-0 form-label col-form-label-sm">Nama Barang</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Masukan nama barang"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kategori" class="mb-0 form-label col-form-label-sm">Kategori</label>
                                    <select class="form-control kategori select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="kategori"
                                        name="kategori" required>
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('kategori') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="supplier" class="mb-0 form-label col-form-label-sm">Supplier Utama</label>
                                    <select class="form-control supplier select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="supplier"
                                        name="supplier">
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
                                    <label for="harga" class="mb-0 form-label col-form-label-sm">Harga Beli</label>
                                    <input type="text" class="price form-control @error('harga') is-invalid @enderror"
                                        id="harga" name="harga" placeholder="Masukan harga beli"
                                        value="{{ old('harga') }}" required>
                                    @error('harga')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="satuan" class="mb-0 form-label col-form-label-sm">Satuan</label>
                                    <select class="form-control satuan select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="satuan"
                                        name="satuan" required>
                                        <option></option>
                                        @foreach ($satuans as $satuan)
                                            <option value="{{ $satuan->id }}"
                                                {{ old('satuan') == $satuan->id ? 'selected' : '' }}>
                                                {{ $satuan->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('satuan')
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

    @foreach ($barang as $data)
        <!-- Modal Edit Data-->
        <div class="modal fade" id="editBarang{{ $data->id }}" tabindex="-1" aria-labelledby="editBarangLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStepModalLabel">Ubah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('barang.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name" class="mb-0 form-label col-form-label-sm">Nama
                                            Barang</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Masukan nama barang"
                                            value="{{ $data->name }}" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kategori{{ $data->id }}"
                                            class="mb-0 form-label col-form-label-sm">Kategori</label>
                                        <select
                                            class="form-control kategori{{ $data->id }} select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;"
                                            id="kategori{{ $data->id }}" name="kategori" required>
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $data->kategori_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="supplier{{ $data->id }}"
                                            class="mb-0 form-label col-form-label-sm">Supplier
                                            Utama</label>
                                        <select
                                            class="form-control supplier{{ $data->id }} select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;"
                                            id="supplier{{ $data->id }}" name="supplier">
                                            <option></option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}"
                                                    {{ $data->supplier_id == $supplier->id ? 'selected' : '' }}>
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="satuan{{ $data->id }}"
                                            class="mb-0 form-label col-form-label-sm">Satuan</label>
                                        <select class="form-control satuan{{ $data->id }} select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;"
                                            id="satuan{{ $data->id }}" name="satuan" required>
                                            <option></option>
                                            @foreach ($satuans as $satuan)
                                                <option value="{{ $satuan->id }}"
                                                    {{ $data->satuan_id == $satuan->id ? 'selected' : '' }}>
                                                    {{ $satuan->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('satuan')
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
            $('#barangTable').DataTable({
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

        $('.satuan').select2({
            placeholder: "Pilih satuan",
            minimumResultsForSearch: -1,
        })
        $('.supplier').select2({
            placeholder: "Pilih supplier",
        })

        $('.kategori').select2({
            placeholder: "Pilih kategori",
            minimumResultsForSearch: -1,
        })

        @foreach ($barang as $data)
            $('.satuan{{ $data->id }}').select2({
                placeholder: "Pilih satuan",
                minimumResultsForSearch: -1,
            })
            $('.supplier{{ $data->id }}').select2({
                placeholder: "Pilih supplier",
            })
            $('.kategori{{ $data->id }}').select2({
                placeholder: "Pilih kategori",
                minimumResultsForSearch: -1,
            })
        @endforeach
    </script>
@endpush
