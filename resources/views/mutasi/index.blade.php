@extends('layouts.admin')

@section('title')
    Laporan Stok
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
                    <h1>Laporan Stok</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Laporan Stok</strong></li>
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
                                    <h3 class="card-title">Laporan Stok</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-primary rounded-tambak float-right"
                                        data-toggle="modal" data-target="#addMutasi">
                                        Tambah Mutasi
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="mutasiTable" class="table table-bordered text-nowrap text-center text-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 5%">
                                            Kategori
                                        </th>
                                        <th style="width: 25%">
                                            Nama Barang
                                        </th>
                                        <th style="width: 5%">
                                            Stok Awal
                                        </th>
                                        <th style="width: 5%">
                                            Masuk
                                        </th>
                                        <th style="width: 5%">
                                            Keluar
                                        </th>
                                        <th style="width: 5%">
                                            Sisa Stok
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $data)
                                        <tr>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->kategori->name }}</td>
                                            @php
                                                $stok_awal = App\Models\Transaksi::where('barang_id', $data->id)
                                                    ->where('status', 'Masuk')
                                                    ->oldest()
                                                    ->first()->kuantitas;
                                                $stok_masuk = App\Models\Transaksi::where('barang_id', $data->id)
                                                    ->where('status', 'Masuk')
                                                    ->sum('kuantitas');
                                                $stok_keluar = App\Models\Transaksi::where('barang_id', $data->id)
                                                    ->where('status', 'Keluar')
                                                    ->sum('kuantitas');
                                                $stok_akhir = $stok_masuk - $stok_keluar;
                                            @endphp
                                            <td>{{ $stok_awal }} {{ $data->satuan->name }}</td>
                                            <td>{{ $stok_masuk }} {{ $data->satuan->name }}</td>
                                            <td>{{ $stok_keluar }} {{ $data->satuan->name }}</td>
                                            <td>{{ $stok_akhir }} {{ $data->satuan->name }}</td>
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
    <div class="modal fade" id="addMutasi" tabindex="-1" aria-labelledby="addMutasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStepModalLabel">Tambah Mutasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="barang" class="mb-0 form-label col-form-label-sm">Barang</label>
                                    <select class="form-control barang select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="barang"
                                        name="barang" required>
                                        <option></option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}"
                                                {{ old('barang') == $barang->id ? 'selected' : '' }}>
                                                {{ $barang->code }} - {{ $barang->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="catatan" class="mb-0 form-label col-form-label-sm">Keterangan</label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" rows="3" placeholder="Tulis catatan"
                                        id="catatan" name="catatan">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status" class="mb-0 form-label col-form-label-sm">Status</label>
                                    <select class="form-control status select2-primary is-invalid"
                                        data-dropdown-css-class="select2-primary" style="width: 100%;" id="status"
                                        name="status">
                                        <option></option>
                                        <option value="Keluar" {{ old('status') == 'Keluar' ? 'selected' : '' }}>
                                            Keluar</option>
                                        <option value="Masuk" {{ old('status') == 'Masuk' ? 'selected' : '' }}>
                                            Masuk</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kuantitas" class="mb-0 form-label col-form-label-sm">Kuantitas</label>
                                    <input type="number" class="form-control @error('kuantitas') is-invalid @enderror"
                                        id="kuantitas" name="kuantitas" placeholder="Masukan kuantitas"
                                        value="{{ old('kuantitas') }}" required>
                                    @error('kuantitas')
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
            $('#mutasiTable').DataTable({
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

        $('.barang').select2({
            placeholder: "Pilih barang",
        })
        $('.status').select2({
            placeholder: "Pilih status",
            minimumResultsForSearch: -1,
            allowClear: true,
        })
    </script>
@endpush
