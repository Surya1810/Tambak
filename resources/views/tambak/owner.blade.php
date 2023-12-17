@extends('layouts.admin')

@section('title')
    Tambak
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
                    <h1>Tambak</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Tambak</strong></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (count($tambak) == null)
                    <div class="col-12 text-center">
                        <h6>Belum Memiliki Tambak</h6>
                    </div>
                @else
                    @foreach ($tambak as $data)
                        <div class="col-12 text-center mb-3">
                            <h5 class="text-center"><strong><u>{{ $data->name }}</u></strong></h5>
                        </div>
                        <!-- Modal Add Data-->
                        <div class="modal fade" id="addKolam{{ $data->id }}" tabindex="-1"
                            aria-labelledby="addKolamLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addStepModalLabel">Tambah Kolam</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('kolam.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="name" class="mb-0 form-label col-form-label-sm">Nama
                                                            Kolam</label>
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="name" name="name" placeholder="Masukan nama kolam"
                                                            value="{{ old('name') }}" required>
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="dalam"
                                                            class="mb-0 form-label col-form-label-sm">Kedalaman</label>
                                                        <div class="input-group mb-2">
                                                            <input type="number"
                                                                class="form-control @error('dalam') is-invalid @enderror"
                                                                id="dalam" name="dalam" required>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">m</div>
                                                            </div>
                                                        </div>
                                                        @error('dalam')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="panjang"
                                                            class="mb-0 form-label col-form-label-sm">Panjang</label>
                                                        <div class="input-group mb-2">
                                                            <input type="number"
                                                                class="form-control @error('panjang') is-invalid @enderror"
                                                                id="panjang" name="panjang" required>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">m</div>
                                                            </div>
                                                        </div>
                                                        @error('panjang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="lebar"
                                                            class="mb-0 form-label col-form-label-sm">Lebar</label>
                                                        <div class="input-group mb-2">
                                                            <input type="number"
                                                                class="form-control @error('lebar') is-invalid @enderror"
                                                                id="lebar" name="lebar" required>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">m</div>
                                                            </div>
                                                        </div>
                                                        @error('lebar')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="anco"
                                                            class="mb-0 form-label col-form-label-sm">Jumlah Anco</label>
                                                        <div class="input-group mb-2">
                                                            <input type="number"
                                                                class="form-control @error('anco') is-invalid @enderror"
                                                                id="anco" name="anco"
                                                                placeholder="Masukan jumlah anco" required>
                                                        </div>
                                                        @error('anco')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="hidden" id="tambak_id" name="tambak_id"
                                                    value="{{ $data->id }}">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary rounded-tambak">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if (count($data->kolam->where('status', true)) == null)
                            <div class="col-12 text-center">
                                <h6>Belum Memiliki Kolam</h6>
                            </div>
                            <div class="col-12 text-center mb-5">
                                <button type="button" data-toggle="modal" data-target="#addKolam{{ $data->id }}"
                                    class="btn btn-primary">
                                    <i class="fa-solid fa-plus"></i><br>
                                    Tambah Kolam
                                </button>
                            </div>
                        @else
                            @foreach ($data->kolam->where('status', true) as $kolam)
                                <div class="col-12 col-md-3 my-2">
                                    <div class="card card-outline rounded-tambak card-primary h-100">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col-6">
                                                    <h3 class="card-title"><b>{{ $kolam->name }}</b></h3>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" class="btn float-right"
                                                        did="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <button class="dropdown-item" type="button" data-toggle="modal"
                                                            data-target="#editKolam{{ $kolam->id }}">Edit</button>
                                                        <button class="dropdown-item"
                                                            onclick="deleteKolam({{ $kolam->id }})">Hapus</button>
                                                        <form id="delete-form-{{ $kolam->id }}"
                                                            action="{{ route('kolam.destroy', $kolam->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-sm table-borderless text-sm w-100">
                                                        <tbody>
                                                            <tr>
                                                                <td>Panjang :</td>
                                                                <td class="float-right"><b>{{ $kolam->panjang }}m</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Lebar :</td>
                                                                <td class="float-right"><b>{{ $kolam->lebar }}m</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Luas :</td>
                                                                <td class="float-right"><b>{{ $kolam->luas }}m</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Anco :</td>
                                                                <td class="float-right"><b>{{ $kolam->anco }}</b></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-sm btn-secondary rounded-tambak"
                                                data-toggle="modal" data-target="#detailKolam{{ $kolam->id }}">
                                                Lihat Status
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Status-->
                                <div class="modal fade" id="detailKolam{{ $kolam->id }}" tabindex="-1"
                                    aria-labelledby="addKolamLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addStepModalLabel">Status Kolam
                                                    {{ $kolam->name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="progress-group">
                                                            DoC
                                                            <span class="float-right"><b>1/400</b></span>
                                                            <div class="progress progress-sm">
                                                                <div class="progress-bar" style="width: 75%"></div>
                                                            </div>
                                                            <small>Tebaran:</small>
                                                            <small class="float-right"><b>300.000</b></small>
                                                        </div>
                                                        <strong>Estimasi Pertumbuhan</strong>
                                                        <table
                                                            class="table table-sm table-striped table-borderless text-sm">
                                                            <tbody>
                                                                <tr>
                                                                    <td>FCR :</td>
                                                                    <td class="float-right"><b>0,01</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ADG :</td>
                                                                    <td class="float-right"><b>0,01</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>SR :</td>
                                                                    <td class="float-right"><b>0,01</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>MBW :</td>
                                                                    <td class="float-right"><b>0,01</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Size :</td>
                                                                    <td class="float-right"><b>0,01</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Total Pakan :</td>
                                                                    <td class="float-right"><b>0,01</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Panen Kumulatif :</td>
                                                                    <td class="float-right"><b>0,01</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Biomassa :</td>
                                                                    <td class="float-right"><b>0,01</b></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Edit Data-->
                                <div class="modal fade" id="editKolam{{ $kolam->id }}" tabindex="-1"
                                    aria-labelledby="editKolamLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editKolamModalLabel">Edit Kolam</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('kolam.update', $kolam->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="name"
                                                                    class="mb-0 form-label col-form-label-sm">Nama
                                                                    Kolam</label>
                                                                <input type="text"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    id="name" name="name"
                                                                    placeholder="Masukan nama kolam"
                                                                    value="{{ $kolam->name }}" required>
                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="dalam"
                                                                    class="mb-0 form-label col-form-label-sm">Kedalaman</label>
                                                                <div class="input-group mb-2">
                                                                    <input type="number"
                                                                        class="form-control @error('dalam') is-invalid @enderror"
                                                                        id="dalam" name="dalam"
                                                                        value="{{ $kolam->kedalaman }}" required>
                                                                    <div class="input-group-append">
                                                                        <div class="input-group-text">m</div>
                                                                    </div>
                                                                </div>
                                                                @error('dalam')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="panjang"
                                                                    class="mb-0 form-label col-form-label-sm">Panjang</label>
                                                                <div class="input-group mb-2">
                                                                    <input type="number"
                                                                        class="form-control @error('panjang') is-invalid @enderror"
                                                                        id="panjang" name="panjang"
                                                                        value="{{ $kolam->panjang }}" required>
                                                                    <div class="input-group-append">
                                                                        <div class="input-group-text">m</div>
                                                                    </div>
                                                                </div>
                                                                @error('panjang')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="lebar"
                                                                    class="mb-0 form-label col-form-label-sm">Lebar</label>
                                                                <div class="input-group mb-2">
                                                                    <input type="number"
                                                                        class="form-control @error('lebar') is-invalid @enderror"
                                                                        id="lebar" name="lebar"
                                                                        value="{{ $kolam->lebar }}" required>
                                                                    <div class="input-group-append">
                                                                        <div class="input-group-text">m</div>
                                                                    </div>
                                                                </div>
                                                                @error('lebar')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="anco"
                                                                    class="mb-0 form-label col-form-label-sm">Jumlah
                                                                    Anco</label>
                                                                <div class="input-group mb-2">
                                                                    <input type="number"
                                                                        class="form-control @error('anco') is-invalid @enderror"
                                                                        id="anco" name="anco"
                                                                        placeholder="Masukan jumlah anco"
                                                                        value="{{ $kolam->anco }}" required>
                                                                </div>
                                                                @error('anco')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary rounded-tambak">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 col-md-3 my-2">
                                <div class="card card-outline rounded-tambak card-primary h-100">
                                    <button type="button" data-toggle="modal"
                                        data-target="#addKolam{{ $data->id }}" class="btn w-100 h-100 text-primary">
                                        <i class="fa-solid fa-plus"></i><br>
                                        Tambah Kolam
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <hr>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function deleteKolam(id) {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe !',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
