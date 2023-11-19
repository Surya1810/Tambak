@extends('layouts.admin')

@section('title')
    Tambah Tambak
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambak</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('tambak.index') }}">Tambak</a>
                        </li>
                        <li class="breadcrumb-item active"><strong>Tambah</strong></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="card rounded-tambak card-outline card-orange w-100">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Tambak</h3>
                    </div>
                    <form action="{{ route('tambak.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Nama Tambak</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Masukan nama tambak"
                                            value="{{ old('name') }}" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="address">Alamat Tambak</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" placeholder="Masukan alamat tambak"
                                            value="{{ old('address') }}" autocomplete="off">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="owner">Owner</label>
                                        <select class="form-control owner select2-orange is-invalid"
                                            data-dropdown-css-class="select2-orange" style="width: 100%;" id="owner"
                                            name="owner">
                                            <option></option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('owner') == $user->id ? 'selected' : '' }}>{{ $user->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('owner')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-vaname rounded-tambak">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.owner').select2({
                placeholder: "Pilih pemilik",
                allowClear: true,
            })
        })
    </script>
@endpush
