@extends('layouts.admin')

@section('title')
    Dummy
@endsection

@push('css')
@endpush

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                {{-- Tambah Data Sampling --}}
                <div class="card rounded-tambak card-outline card-orange w-100">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Sampling</h3>
                    </div>
                    <form action="{{ route('owner.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="kolam" class="mb-0 form-label col-form-label-sm">Kolam</label>
                                        <select class="form-control kolam select2-orange is-invalid"
                                            data-dropdown-css-class="select2-orange" style="width: 100%;" id="kolam"
                                            name="kolam">
                                            <option></option>
                                            {{-- @foreach ($kolams as $kolam)
                                                <option value="{{ $kolam->name }}"
                                                    {{ old('kolam') == $kolam->name ? 'selected' : '' }}>{{ $tambak->name }} - 
                                                    {{ $kolam->name }}</option>
                                            @endforeach --}}
                                        </select>
                                        @error('kolam')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal" class="mb-0 form-label col-form-label-sm">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" placeholder="Pilih Tanggal"
                                            value="{{ old('tanggal') }}" autocomplete="off">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="mbw" class="mb-0 form-label col-form-label-sm">MBW (gr)</label>
                                        <input type="number" class="form-control @error('mbw') is-invalid @enderror"
                                            id="mbw" name="mbw" placeholder="Masukan berat rata-rata udang"
                                            value="{{ old('mbw') }}" autocomplete="off">
                                        @error('mbw')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="catatan" class="mb-0 form-label col-form-label-sm">Catatan</label>
                                        <textarea class="form-control @error('catatan') is-invalid @enderror" rows="3"
                                            placeholder="Tulis catatan bila ada..." id="catatan" name="catatan">{{ old('catatan') }}</textarea>
                                        @error('catatan')
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

                {{-- Input Data Tebar Bibit --}}
                <div class="card rounded-tambak card-outline card-orange w-100">
                    <div class="card-header">
                        <h3 class="card-title">Data Tebar Bibit</h3>
                    </div>
                    <form action="{{ route('owner.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="kolam" class="mb-0 form-label col-form-label-sm">Kolam</label>
                                        <select class="form-control kolam select2-orange is-invalid"
                                            data-dropdown-css-class="select2-orange" style="width: 100%;" id="kolam"
                                            name="kolam">
                                            <option></option>
                                            {{-- @foreach ($kolams as $kolam)
                                                <option value="{{ $kolam->name }}"
                                                    {{ old('kolam') == $kolam->name ? 'selected' : '' }}>{{ $tambak->name }} - 
                                                    {{ $kolam->name }}</option>
                                            @endforeach --}}
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
                                        <label for="supplier" class="mb-0 form-label col-form-label-sm">Hatchery</label>
                                        <select class="form-control supplier select2-orange is-invalid"
                                            data-dropdown-css-class="select2-orange" style="width: 100%;" id="col-lg-6"
                                            name="col-lg-6">
                                            <option></option>
                                            {{-- @foreach ($kolams as $kolam)
                                                <option value="{{ $kolam->name }}"
                                                    {{ old('kolam') == $kolam->name ? 'selected' : '' }}>
                                                    {{ $kolam->name }}</option>
                                            @endforeach --}}
                                        </select>
                                        @error('col-lg-6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal" class="mb-0 form-label col-form-label-sm">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" placeholder="Pilih Tanggal"
                                            value="{{ old('tanggal') }}" autocomplete="off">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="total" class="mb-0 form-label col-form-label-sm">Total Tebar
                                            (ekor)</label>
                                        <input type="number" class="form-control @error('total') is-invalid @enderror"
                                            id="total" name="total" placeholder="Masukan total pakan"
                                            value="{{ old('total') }}" autocomplete="off">
                                        @error('total')
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
        $('.kolam').select2({
            placeholder: "Pilih kolam",
        })
        $('.pakan').select2({
            placeholder: "Pilih jenis pakan",
        })
        $('.supplier').select2({
            placeholder: "Pilih hatchery (opsional)",
        })
    </script>
@endpush
