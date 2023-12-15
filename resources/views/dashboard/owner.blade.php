@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@push('css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <h4><b>Status Kolam</b></h4>
                </div>
                @if (count($tambak) == null)
                    <div class="col-12 text-center">
                        <h6>Belum Memiliki Tambak</h6>
                    </div>
                @else
                    @foreach ($tambak as $data)
                        <div class="col-12 text-center mb-3">
                            <h5 class="text-center"><strong><u>{{ $data->name }}</u></strong></h5>
                        </div>
                        @if (count($data->kolam) == null)
                            <div class="col-12 text-center mb-5">
                                <h6>Belum Memiliki Kolam</h6>
                                <hr>
                            </div>
                        @else
                            @foreach ($data->kolam as $kolam)
                                <div class="col-lg-3 col-12">
                                    <div class="card card-outline rounded-tambak card-primary">
                                        <div class="card-header">
                                            <div class="row align-items-center ">
                                                <h3 class="card-title"><b>{{ $kolam->name }}</b></h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="progress-group">
                                                        DoC
                                                        <span class="float-right"><b>1/400</b></span>
                                                        <div class="progress progress-sm">
                                                            <div class="progress-bar bg-vaname" style="width: 75%"></div>
                                                        </div>
                                                        <small>Tebaran:</small>
                                                        <small class="float-right"><b>300.000</b></small>
                                                    </div>
                                                    <strong>Estimasi Pertumbuhan</strong>
                                                    <table class="table table-sm table-striped table-borderless text-sm">
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
                                        <div class="card-footer text-center rounded-tambak">
                                            <button class="btn btn-sm btn-secondary rounded-tambak">Konsultasi</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="col-12 mb-3">
                            <hr>
                        </div>
                    @endforeach
                @endif
            </div>
            {{-- <div class="row">
                @if (auth()->user()->tambak->count() != null)
                    <div class="col-12 col-lg-6">
                        <div class="card card-outline rounded-tambak card-primary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h3 class="card-title">Daftar Karyawan</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table id="karyawanTable" class="table table-bordered text-nowrap text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width: 10%">
                                                No
                                            </th>
                                            <th style="width: 45%">
                                                Nama
                                            </th>
                                            <th style="width: 45%">
                                                Info
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawans as $key => $karyawan)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $karyawan->name }}</td>
                                                <td>{{ $karyawan->getRoleNames()->first() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer rounded-tambak text-center">
                                <a href="{{ route('operator.index') }}"
                                    class="btn btn-sm btn-secondary rounded-tambak">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div> --}}
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#karyawanTable').DataTable({
                "paging": true,
                'processing': true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                // "scrollX": true,
                // width: "700px",
                // columnDefs: [{
                //     className: 'dtr-control',
                //     orderable: false,
                //     targets: -8
                // }]
            });
        });
    </script>
@endpush
