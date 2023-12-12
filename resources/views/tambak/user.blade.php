@extends('layouts.admin')

@section('title')
    Kolam
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kolam</h1>
                    <ol class="breadcrumb text-black-50">
                        <li class="breadcrumb-item"><a class="text-black-50" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Kolam</strong></li>
                    </ol>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-sm btn-primary rounded-tambak float-right" data-toggle="modal"
                        data-target="#addSatuan">
                        Tambah Kolam
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($kolam as $data)
                    <div class="col-6 col-md-3">
                        <div class="card card-outline rounded-tambak card-primary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <h3 class="card-title">{{ $data->nama }}</h3>
                                </div>
                            </div>
                            <div class="card-body">
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-secondary rounded-vaname">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Modal Add Data-->
    <div class="modal fade" id="addSatuan" tabindex="-1" aria-labelledby="addSatuanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStepModalLabel">Tambah Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('akun.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="mb-0 form-label col-form-label-sm">Nama Kolam</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Masukan nama kolam"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="dalam" class="mb-0 form-label col-form-label-sm">Kedalaman</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control @error('dalam') is-invalid @enderror"
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="panjang" class="mb-0 form-label col-form-label-sm">Panjang</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control @error('panjang') is-invalid @enderror"
                                            id="panjang" name="name" required>
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="lebar" class="mb-0 form-label col-form-label-sm">Lebar</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control @error('lebar') is-invalid @enderror"
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
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="anco" class="mb-0 form-label col-form-label-sm">Jumlah Anco</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control @error('anco') is-invalid @enderror"
                                            id="anco" name="anco" placeholder="Masukan jumlah anco" required>
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
                        <button type="submit" class="btn btn-primary rounded-tambak">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function deleteSatuan(id) {
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
