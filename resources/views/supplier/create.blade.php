@extends('layouts.admin')

@section('title')
    Tambah Supplier
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Supplier</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('supplier.index') }}">Supplier</a>
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
                        <h3 class="card-title">Tambah Supplier</h3>
                    </div>
                    <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nama Supplier</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Masukan nama supplier"
                                            value="{{ old('name') }}" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="address">Alamat Supplier</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" placeholder="Masukan alamat supplier"
                                            value="{{ old('address') }}" autocomplete="off">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="phone">Nomor Hp</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" placeholder="Masukan nomor supplier"
                                            value="{{ old('phone') }}" autocomplete="off">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="contact">Kontak Person</label>
                                        <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                            id="contact" name="contact" placeholder="Masukan nama supplier"
                                            value="{{ old('contact') }}" autocomplete="off">
                                        @error('contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="tempo">Tempo Pembayaran</label>
                                        <input type="number" class="form-control @error('tempo') is-invalid @enderror"
                                            id="tempo" name="tempo" placeholder="Masukan tempo pembayaran supplier"
                                            value="{{ old('tempo') }}" autocomplete="off">
                                        @error('tempo')
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
@endpush
