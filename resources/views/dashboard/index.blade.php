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
                            <div class="col-12 text-center">
                                <h5 class="text-center"><strong>{{ $data->name }}</strong></h5>
                            </div>
                            @if (count($data->kolam) == null)
                                <div class="col-12 text-center">
                                    <h6>Belum Memiliki Kolam</h6>
                                </div>
                            @else
                                @foreach ($data->kolam as $kolam)
                                    <div class="col-lg-3 col-6">
                                        <div class="card card-outline rounded-tambak card-orange">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <h3 class="card-title">{{ $kolam->name }}</h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">{{ $kolam->panjang }}m</div>
                                                    <div class="col-6">{{ $kolam->lebar }}m</div>
                                                    <div class="col-6">{{ $kolam->luas }}m</div>
                                                    <div class="col-6">{{ $kolam->anco }}m</div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center">
                                                <button class="btn btn-sm btn-secondary rounded-tambak">Lihat Detail</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
                <hr>
            @endrole
        </div>
    </section>
@endsection

@push('scripts')
@endpush
