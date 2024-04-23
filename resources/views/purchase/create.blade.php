@extends('layouts.admin')

@section('title')
    Tambah Nota PO
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nota PO</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('panen.index') }}">PO</a>
                        </li>
                        <li class="breadcrumb-item active"><strong>Buat</strong></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="card rounded-tambak card-outline card-primary w-100">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Nota PO</h3>
                    </div>
                    <form action="{{ route('PO.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal" class="mb-0 form-label col-form-label-sm">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" value="{{ old('tanggal') }}" autocomplete="off"
                                            required>
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
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
                                <div class="col-12">
                                    <div id="items">
                                        <div class="form-row item-row">
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="barang"
                                                        class="mb-0 form-label col-form-label-sm">Barang</label>
                                                    <select class="form-control" style="width: 100%;" id="barang"
                                                        name="items[0][barang_id]" required>
                                                        <option disabled selected hidden>Pilih barang</option>
                                                        @foreach ($barangs as $barang)
                                                            <option value="{{ $barang->id }}"
                                                                {{ old('barang') == $barang->id ? 'selected' : '' }}>
                                                                {{ $barang->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('supplier')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="qty">Kuantitas</label>
                                                    <div class="input-group">
                                                        <input type="number"
                                                            class="form-control @error('qty') is-invalid @enderror"
                                                            id="qty" name="items[0][qty]"
                                                            placeholder="Masukan kuantitas" value="{{ old('qty') }}"
                                                            autocomplete="off" min="1" required>

                                                        {{-- <div class="input-group-append">
                                                            <span class="input-group-text" id="qty">hari</span>
                                                        </div> --}}
                                                    </div>
                                                    @error('qty')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="price">Harga</label>
                                                    <div class="input-group">
                                                        <input type="text"
                                                            class="price form-control @error('price') is-invalid @enderror"
                                                            id="price" name="items[0][price]"
                                                            placeholder="Masukan harga" value="{{ old('price') }}"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary float-right"
                                        id="add-item">Tambah</button>
                                    <button type="button" class="btn btn-danger float-right mx-2"
                                        id="remove-item">Hapus</button>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="keterangan" class="mb-0 form-label col-form-label-sm">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Tulis keterangan"
                                            id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary rounded-tambak">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/adminLTE/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <script>
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
            minimumResultsForSearch: -1,
            allowClear: true,
        })
    </script>

    <script>
        $(document).ready(function() {
            // Counter for dynamic field IDs
            let itemId = 1;

            // Add new item fields
            // Add new item fields
            $('#add-item').click(function() {
                $('#items').append(
                    `          <div class="form-row mt-3 item-row">
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="barang"
                                                        class="mb-0 form-label col-form-label-sm">Barang</label>
                                                    <select class="form-control" style="width: 100%;" id="barang"
                                                        name="items[${itemId}][barang_id]" required>
                                                        <option disabled selected hidden>Pilih barang</option>
                                                        @foreach ($barangs as $barang)
                                                            <option value="{{ $barang->id }}"
                                                                {{ old('barang') == $barang->id ? 'selected' : '' }}>
                                                                {{ $barang->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('supplier')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="qty">Kuantitas</label>
                                                    <div class="input-group">
                                                        <input type="number"
                                                            class="form-control @error('qty') is-invalid @enderror"
                                                            id="qty" name="items[${itemId}][qty]"
                                                            placeholder="Masukan kuantitas" value="{{ old('qty') }}"
                                                            autocomplete="off" min="1" required>

                                                                                                                    <div class="input-group-append">
                                                            <span class="input-group-text" id="qty">hari</span>
                                                        </div>
                                                    </div>
                                                    @error('qty')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="price">Harga</label>
                                                    <div class="input-group">
                                                        <input type="number"
                                                            class="price form-control @error('price') is-invalid @enderror"
                                                            id="price" name="items[${itemId}][price]"
                                                            placeholder="Masukan harga" value=""
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
                );
                itemId++;
            });

            // Remove item fields
            $('#remove-item').click(function() {
                $('.item-row:last').remove();
                itemId--;
            });
        });
    </script>
@endpush
