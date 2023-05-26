@extends('layout.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Peserta</h4>
                    </div>
                    <div class="card-body">
                    {{ number_format($total_participant) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection