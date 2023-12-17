@extends('layouts.admin')

@section('title')
    Tambah Data Panen
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Panen</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('panen.index') }}">Panen</a>
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
                        <h3 class="card-title">Tambah Data Panen</h3>
                    </div>
                    <form action="{{ route('panen.store') }}" method="POST" enctype="multipart/form-data"
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
                                        <label for="jenis_panen" class="mb-0 form-label col-form-label-sm">Jenis
                                            Panen</label>
                                        <select class="form-control jenis_panen select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;" id="jenis_panen"
                                            name="jenis_panen">
                                            <option></option>
                                            <option value="Partial" {{ old('jenis_panen') == 'Partial' ? 'selected' : '' }}>
                                                Partial</option>
                                            <option value="Total" {{ old('jenis_panen') == 'Total' ? 'selected' : '' }}>
                                                Total</option>
                                        </select>
                                        @error('jenis_panen')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="grade" class="mb-0 form-label col-form-label-sm">Grade</label>
                                        <input type="text" class="form-control @error('grade') is-invalid @enderror"
                                            id="grade" name="grade" placeholder="Pilih grade"
                                            value="{{ old('grade') }}" autocomplete="off">
                                        @error('grade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="size" class="mb-0 form-label col-form-label-sm">Size</label>
                                        <input type="number" step=".1"
                                            class="form-control @error('size') is-invalid @enderror" id="size"
                                            name="size" placeholder="Masukan size" value="{{ old('size') }}"
                                            autocomplete="off">
                                        @error('size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="volume" class="mb-0 form-label col-form-label-sm">Volume</label>
                                        <input type="number" step=".01"
                                            class="form-control @error('volume') is-invalid @enderror" id="volume"
                                            name="volume" placeholder="Masukan volume" value="{{ old('volume') }}"
                                            autocomplete="off">
                                        @error('volume')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
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
        $('.jenis_panen').select2({
            placeholder: "Pilih jenis panen",
        })
        $('.satuan').select2({
            placeholder: "Pilih satuan",
        })
    </script>
@endpush
