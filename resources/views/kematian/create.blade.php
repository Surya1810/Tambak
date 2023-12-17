@extends('layouts.admin')

@section('title')
    Tambah Data Kematian Udang
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kematian Udang</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('kematian.index') }}">Data
                                Kematian Udang</a>
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
                        <h3 class="card-title">Tambah Data Kematian Udang</h3>
                    </div>
                    <form action="{{ route('kematian.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="kolam" class="mb-0 form-label col-form-label-sm">Kolam</label>
                                        <select class="form-control kolam select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;" id="kolam"
                                            name="kolam" required>
                                            <option></option>
                                            @foreach ($kolams as $kolam)
                                                <option value="{{ $kolam->id }}"
                                                    {{ old('kolam') == $kolam->id ? 'selected' : '' }}>
                                                    {{ $kolam->tambak->name }} -
                                                    {{ $kolam->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kolam')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal" class="mb-0 form-label col-form-label-sm">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" placeholder="Pilih tanggal"
                                            value="{{ old('tanggal') }}" autocomplete="off">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="umur" class="mb-0 form-label col-form-label-sm">Umur</label>
                                        <input type="number" class="form-control @error('umur') is-invalid @enderror"
                                            id="umur" name="umur" placeholder="Masukan umur"
                                            value="{{ old('umur') }}" autocomplete="off">
                                        @error('umur')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="total" class="mb-0 form-label col-form-label-sm">Total Berat
                                            (Kg)</label>
                                        <input type="number" step=".01"
                                            class="form-control @error('total') is-invalid @enderror" id="total"
                                            name="total" placeholder="Masukan total berat" value="{{ old('total') }}"
                                            autocomplete="off">
                                        @error('total')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="size" step=".1" class="mb-0 form-label col-form-label-sm">Size
                                            (ekor/Kg)</label>
                                        <input type="number" class="form-control @error('size') is-invalid @enderror"
                                            id="size" name="size" placeholder="Masukan size"
                                            value="{{ old('size') }}" autocomplete="off">
                                        @error('size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="jumlah" class="mb-0 form-label col-form-label-sm">Jumlah
                                            (ekor)</label>
                                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                            id="jumlah" name="jumlah" placeholder="Masukan jumlah"
                                            value="{{ old('jumlah') }}" autocomplete="off">
                                        @error('jumlah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary rounded-tambak">Buat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('.kolam').select2({
            placeholder: "Pilih kolam",
        })
    </script>
@endpush
