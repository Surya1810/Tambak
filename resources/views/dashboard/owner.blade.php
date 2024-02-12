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
                            @foreach ($data->kolam->where('status', true) as $kolam)
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
                                                        <span class="float-right">
                                                            <b>
                                                                @isset($kolam->bibit()->latest()->first()->tanggal)
                                                                    {{ now()->diffInDays($kolam->bibit()->latest()->first()->tanggal) }}
                                                                @else
                                                                    -
                                                                @endisset/ 100
                                                            </b>
                                                        </span>
                                                        <div class="progress progress-sm">
                                                            <div class="progress-bar bg-vaname"
                                                                style="width:  @isset($kolam->bibit()->latest()->first()->tanggal)
                                                                     {{ now()->diffInDays($kolam->bibit()->latest()->first()->tanggal) }}
                                                                     @else
                                                                            -
                                                                @endisset%">
                                                            </div>
                                                        </div>
                                                        <small>Tebaran:</small>
                                                        <small class="float-right">
                                                            <b>
                                                                @isset($kolam->bibit()->latest()->first()->total)
                                                                    {{ number_format($kolam->bibit()->latest()->first()->total, 0, ',', '.') }}
                                                                @else
                                                                    -
                                                                @endisset
                                                            </b>
                                                        </small>
                                                    </div>
                                                    <strong>Estimasi Pertumbuhan</strong>
                                                    <table class="table table-sm table-striped table-borderless text-sm">
                                                        @php
                                                            if (isset($kolam->sampling()->latest()->first()->mbw)) {
                                                                $dataFR = App\Models\FR::all()->pluck('fr', 'mbw');

                                                                $MBWYangDicari = $kolam->sampling()->latest('tanggal')->first()->mbw;

                                                                if ($dataFR->has($MBWYangDicari)) {
                                                                    $data_fr = $dataFR[$MBWYangDicari];
                                                                } else {
                                                                    $mbwTerdekatSebelumnya = $dataFR
                                                                        ->filter(function ($fr, $mbw) use ($MBWYangDicari) {
                                                                            return $mbw < $MBWYangDicari;
                                                                        })
                                                                        ->keys()
                                                                        ->max();

                                                                    $mbwTerdekatSelanjutnya = $dataFR
                                                                        ->filter(function ($fr, $mbw) use ($MBWYangDicari) {
                                                                            return $mbw > $MBWYangDicari;
                                                                        })
                                                                        ->keys()
                                                                        ->min();

                                                                    if ($mbwTerdekatSebelumnya !== null && $mbwTerdekatSelanjutnya !== null) {
                                                                        $frTerdekatSebelumnya = $dataFR[$mbwTerdekatSebelumnya];
                                                                        $frTerdekatSelanjutnya = $dataFR[$mbwTerdekatSelanjutnya];

                                                                        $data_fr = (($MBWYangDicari - $mbwTerdekatSebelumnya) * ($frTerdekatSelanjutnya - $frTerdekatSebelumnya)) / ($mbwTerdekatSelanjutnya - $mbwTerdekatSebelumnya) + $frTerdekatSebelumnya;
                                                                    } else {
                                                                        $data_fr = null;
                                                                    }
                                                                }
                                                            }

                                                            if ($kolam->pakan()->latest('tanggal') !== null && isset($data_fr)) {
                                                                $biomassa = $kolam->pakan()->latest('tanggal')->sum('jumlah') / (number_format((float) $data_fr, 2, '.', '') / 100);
                                                            }

                                                            if (isset($biomassa) && isset($kolam->sampling()->latest('tanggal')->first()->mbw)) {
                                                                $populasi = number_format((float) $biomassa, 2, '.', '') * (1000 / $kolam->sampling()->latest('tanggal')->first()->mbw);
                                                            }

                                                            if (isset($populasi) && isset($kolam->sampling()->latest('tanggal')->first()->mbw)) {
                                                                $biomass = $populasi * $kolam->sampling()->latest('tanggal')->first()->mbw;
                                                            }
                                                        @endphp
                                                        <tbody>
                                                            <tr>
                                                                <td>FCR :</td>
                                                                <td class="float-right">
                                                                    <b>
                                                                        @isset($kolam->bibit()->latest()->first()->tanggal)
                                                                            @if (
                                                                                $kolam->pakan()->whereBetween('tanggal', [$kolam->bibit()->latest('tanggal')->first()->tanggal, Carbon\Carbon::today()])->sum('jumlah') > 0 &&
                                                                                    isset($biomassa) &&
                                                                                    $biomassa > 0)
                                                                                {{ number_format((float) $kolam->pakan()->whereBetween('tanggal', [$kolam->bibit()->latest('tanggal')->first()->tanggal, Carbon\Carbon::yesterday()])->sum('jumlah') / $biomassa,2,'.','') }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @else
                                                                            -
                                                                        @endisset
                                                                    </b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>ADG :</td>
                                                                <td class="float-right">
                                                                    <b>
                                                                        @if ($kolam->sampling()->count() > 1)
                                                                            {{ number_format((float) $kolam->sampling()->latest('tanggal')->first()->mbw -$kolam->sampling()->latest('tanggal')->skip(1)->first()->mbw /$kolam->sampling()->latest('tanggal')->skip(1)->first()->tanggal->diffInDays($kolam->sampling()->latest('tanggal')->first()->tanggal),2,'.','') }}
                                                                            g
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>SR :</td>
                                                                <td class="float-right">
                                                                    <b>
                                                                        @if (isset($kolam->bibit()->latest('tanggal')->first()->total) &&
                                                                                isset($kolam->sampling()->latest('tanggal')->first()->mbw) &&
                                                                                isset($biomassa) &&
                                                                                $biomassa > 0)
                                                                            {{ number_format(((float) $biomassa * (1000 / $kolam->sampling()->latest('tanggal')->first()->mbw) * 100) / $kolam->bibit()->latest('tanggal')->first()->total, 2, '.', '') }}
                                                                            %
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>MBW :</td>
                                                                <td class="float-right">
                                                                    <b>
                                                                        @isset($kolam->sampling()->latest('tanggal')->first()->mbw)
                                                                            {{ $kolam->sampling()->latest('tanggal')->first()->mbw }}
                                                                            g
                                                                        @else
                                                                            -
                                                                        @endisset
                                                                    </b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Size :</td>
                                                                <td class="float-right">
                                                                    <b>
                                                                        @isset($kolam->sampling()->latest('tanggal')->first()->mbw)
                                                                            {{ number_format((float) 1000 / $kolam->sampling()->latest('tanggal')->first()->mbw, 2, '.', '') }}
                                                                        @else
                                                                            -
                                                                        @endisset
                                                                    </b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Pakan :</td>
                                                                <td class="float-right">
                                                                    <b>

                                                                        @isset($kolam->bibit()->latest('tanggal')->first()->tanggal)
                                                                            @if ($kolam->pakan()->whereBetween('tanggal', [$kolam->bibit()->latest('tanggal')->first()->tanggal, Carbon\Carbon::today()])->sum('jumlah') > 0)
                                                                                {{ $kolam->pakan()->whereBetween('tanggal', [$kolam->bibit()->latest('tanggal')->first()->tanggal, Carbon\Carbon::today()])->sum('jumlah') }}
                                                                                Kg
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @else
                                                                            -
                                                                        @endisset
                                                                    </b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Biomassa :</td>
                                                                <td class="float-right">
                                                                    <b>
                                                                        @if (isset($biomassa) && $biomassa > 0)
                                                                            {{ number_format((float) $biomassa, 2, '.', '') }}
                                                                            Kg
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </b>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
