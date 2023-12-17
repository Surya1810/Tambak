@extends('layouts.admin')

@section('title')
    Ubah Karyawan
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Karyawan</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('operator.index') }}">Karyawan</a>
                        </li>
                        <li class="breadcrumb-item active"><strong>Ubah</strong></li>
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
                        <h3 class="card-title">Ubah Karyawan</h3>
                    </div>
                    <form action="{{ route('operator.update', $karyawan->id) }}" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Masukan nama Karyawan"
                                            value="{{ $karyawan->name }}" autocomplete="off">
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
                                            id="username" name="username" placeholder="Masukan username karyawan"
                                            value="{{ $karyawan->username }}" autocomplete="off">
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
                                            id="phone" name="phone" placeholder="Masukan nomor karyawan"
                                            value="{{ $karyawan->phone }}" autocomplete="off">
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
                                            id="email" name="email" placeholder="Masukan email karyawan"
                                            value="{{ $karyawan->email }}" autocomplete="off">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Masukan password karyawan"
                                            value="{{ $password }}" autocomplete="off">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="role" class="mb-0 form-label col-form-label-sm">Posisi</label>
                                        <select class="form-control role select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;" id="role"
                                            name="role">
                                            <option></option>
                                            <option value="operator"
                                                {{ $karyawan->getRoleNames()->first() == 'operator' ? 'selected' : '' }}>
                                                Operator</option>
                                            <option value="akuntan"
                                                {{ $karyawan->getRoleNames()->first() == 'akuntan' ? 'selected' : '' }}>
                                                Akuntan</option>
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
                                        <label for="tambak" class="mb-0 form-label col-form-label-sm">Tambak</label>
                                        <select class="form-control tambak select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;" id="tambak"
                                            name="tambak">
                                            <option></option>
                                            @foreach ($tambaks as $tambak)
                                                <option value="{{ $tambak->id }}"
                                                    {{ $karyawan->tambak->first()->id == $tambak->id ? 'selected' : '' }}>
                                                    {{ $tambak->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('tambak')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary rounded-tambak">Ubah</button>
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
            $('.role').select2({
                placeholder: "Pilih posisi",
                minimumResultsForSearch: -1,
                allowClear: true,
            })
            $('.tambak').select2({
                placeholder: "Pilih tambak",
            })
        })
    </script>
@endpush
