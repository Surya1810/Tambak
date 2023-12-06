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
                    <h1>Status Kolam</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @role('super admin')
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-vaname">
                            <div class="inner">
                                <h3>{{ $owner }}</h3>

                                <p>Jumlah Owner</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('owner.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-vaname">
                            <div class="inner">
                                <h3>{{ $tambak }}</h3>

                                <p>Jumlah Tambak</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('tambak.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endrole
            @role('owner')
                <div class="row">
                    @if (count($tambak) == null)
                        <div class="col-12 text-center">
                            <h6>Belum Memiliki Tambak</h6>
                        </div>
                    @else
                        @foreach ($tambak as $data)
                            <div class="col-12 text-center mb-3">
                                <h5 class="text-center"><strong>{{ $data->name }}</strong></h5>
                            </div>
                            @if (count($data->kolam) == null)
                                <div class="col-12 text-center mb-5">
                                    <h6>Belum Memiliki Kolam</h6>
                                    <hr>
                                </div>
                            @else
                                @foreach ($data->kolam as $kolam)
                                    <div class="col-lg-3 col-6">
                                        <div class="card card-outline rounded-tambak card-orange">
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
                                                                    <td>SR :</td>
                                                                    <td class="float-right"><b>0,01</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>MBW :</td>
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
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center">
                                                <button class="btn btn-sm btn-secondary rounded-tambak">Konsultasi</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
            @endrole
        </div>
    </section>
@endsection

@push('scripts')
@endpush
