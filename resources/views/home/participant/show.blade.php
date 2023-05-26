@extends('layout.app')

@push('style')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lihat Laporan Peserta</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <a href="{{ route('home.participant.index') }}" class="btn btn-danger me-2"><i class="fas fa-times me-2"></i>Kembali</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="mb-5">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td class="fw-bold">{{ $participant->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td class="fw-bold">{{ $participant->email }}</td>
                    </tr>
                </table>
                
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>Aspek</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Aspek Intelegensi</td>
                            <td>@if($assessment->intelligence_aspect == 1) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                            <td>@if($assessment->intelligence_aspect == 2) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                            <td>@if($assessment->intelligence_aspect == 3) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                            <td>@if($assessment->intelligence_aspect == 4) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                            <td>@if($assessment->intelligence_aspect >= 5) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                        </tr>
                        <tr>
                            <td>Aspek Numerical Ability</td>
                            <td>@if($assessment->numerical_ability_aspect == 1) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                            <td>@if($assessment->numerical_ability_aspect == 2) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                            <td>@if($assessment->numerical_ability_aspect == 3) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                            <td>@if($assessment->numerical_ability_aspect == 4) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                            <td>@if($assessment->numerical_ability_aspect >= 5) <i class="far fa-check-circle fa-lg text-success"></i> @endif</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection