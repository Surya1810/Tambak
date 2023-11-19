@extends('layouts.admin')

@section('title')
    Tambah Operator
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Operator</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('operator.index') }}">Operator</a>
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
                <div class="card rounded-tambak card-outline card-orange w-100">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Operator</h3>
                    </div>
                    <form action="{{ route('operator.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Masukan nama operator"
                                            value="{{ old('name') }}" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" placeholder="Masukan username operator"
                                            value="{{ old('username') }}" autocomplete="off">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="phone">Nomor Hp</label>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" placeholder="Masukan nomor operator"
                                            value="{{ old('phone') }}" autocomplete="off">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Masukan email operator"
                                            value="{{ old('email') }}" autocomplete="off">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-vaname rounded-tambak">Buat</button>
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
