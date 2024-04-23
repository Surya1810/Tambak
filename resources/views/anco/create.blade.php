@extends('layouts.admin')

@section('title')
    Tambah data cek anco
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Cek Anco</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('kematian.index') }}">Data Cek
                                Anco</a>
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
                        <h3 class="card-title">Tambah Data Cek Anco</h3>
                    </div>
                    <form action="{{ route('anco.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kolam" class="mb-0 form-label col-form-label-sm">Kolam</label>
                                        <select class="form-control kolam select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;" id="kolam"
                                            name="kolam" required>
                                            <option></option>
                                            @foreach ($kolams as $kolam)
                                                <option value="{{ $kolam->id }}"
                                                    {{ old('kolam') == $kolam->name ? 'selected' : '' }}>
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal" class="mb-0 form-label col-form-label-sm">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" placeholder="Pilih Tanggal"
                                            value="{{ old('tanggal') }}" autocomplete="off" required>
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="pakan" class="mb-0 form-label col-form-label-sm">Pakan</label>
                                        <select class="form-control pakan select2-primary is-invalid"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;" id="pakan"
                                            name="pakan" required>

                                        </select>
                                        @error('pakan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="waktu" class="mb-0 form-label col-form-label-sm">Waktu Cek
                                            Anco</label>
                                        <input type="time" class="form-control @error('waktu') is-invalid @enderror"
                                            id="waktu" name="waktu" placeholder="Masukan alamat tambak"
                                            value="{{ old('waktu') }}" autocomplete="off" required>
                                        @error('waktu')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="ancos_container">

                                </div>
                                <div class="col-12">
                                    <div class="card bg-info">
                                        <div class="card-body">
                                            <table>
                                                <tr>
                                                    <td>&lt;10%</td>
                                                    <td>=</td>
                                                    <td>Habis</td>
                                                </tr>
                                                <tr>
                                                    <td>10% - 50%</td>
                                                    <td>=</td>
                                                    <td>Sisa Sedikit</td>
                                                </tr>
                                                <tr>
                                                    <td>&gt;50%</td>
                                                    <td>=</td>
                                                    <td>Sisa Banyak</td>
                                                </tr>
                                            </table>
                                        </div>
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
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary rounded-tambak">Tambah</button>
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
            placeholder: "Pilih waktu pemberian pakan",
        })
    </script>

    <script>
        $(document).ready(function() {
            var kolamSelect = $('#kolam');
            var tanggalSelect = $('#tanggal');
            var pakanSelect = $('#pakan');

            kolamSelect.on('change', function() {
                // Memanggil fungsi untuk refresh data pakan saat kolam berubah
                refreshDataPakan();
                Anco();
            });

            tanggalSelect.on('change', function() {
                // Memanggil fungsi untuk refresh data pakan saat tanggal berubah
                refreshDataPakan();
            });

            pakanSelect.on('change', function() {
                // Tambahkan logika jika diperlukan saat memilih opsi pakan tertentu
            });

            function refreshDataPakan() {
                var selectedTanggal = tanggalSelect.val();
                var selectedKolam = kolamSelect.val();

                if (selectedKolam && selectedTanggal) {
                    $.ajax({
                        url: '/operator/anco/create/' + selectedKolam + '/' + selectedTanggal,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            pakanSelect.empty();

                            // Tambahkan opsi pakan ke nilai default tidak dipilih
                            pakanSelect.append(
                                '<option></option>');

                            $.each(data, function(index, value) {
                                // Tambahkan opsi pakan
                                pakanSelect.append('<option value="' + value.id + ' ">' +
                                    value.formattedWaktu + ' (' +
                                    value.jumlah + ' Kg)</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }

            function Anco() {
                var kolam_id = kolamSelect.val();

                if (kolam_id) {
                    $.ajax({
                        url: '/operator/anco/create/' + kolam_id,
                        type: 'GET',
                        success: function(response) {
                            var anco_count = response.anco_count;
                            $('#ancos_container').empty();
                            for (var i = 1; i <= anco_count; i++) {

                                var input =
                                    '<div class="col-12"><div class="form-group"><legend class="col-form-label-sm"><strong>Anco ' +
                                    i +
                                    '</strong></legend><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="anco[' +
                                    i +
                                    ']" id="inlineRadio1" value="1" required><label class="form-check-label" for="inlineRadio1">Habis</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="anco[' +
                                    i +
                                    ']" id="inlineRadio2" value="2" required><label class="form-check-label" for="inlineRadio2">Sisa Sedikit</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="anco[' +
                                    i +
                                    ']" id="inlineRadio3" value="3" required><label class="form-check-label" for="inlineRadio3">Sisa Banyak</label></div>@error("anco'+ i +'")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div>';
                                $('#ancos_container').append(input);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }
        });
    </script>
@endpush
