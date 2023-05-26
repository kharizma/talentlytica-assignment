@extends('layout.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Peserta</h1>
            <div class="section-header-breadcrumb d-none d-sm-block">
                <nav class="mt-3" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Peserta</li>
                        <li class="breadcrumb-item">Ubah Peserta</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <a href="{{ route('home.participant.index') }}" class="btn btn-danger me-2"><i class="fas fa-times me-2"></i>Batal</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div class="ms-2">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('home.participant.update',$participant->id) }}" method="POST" class="needs-validation mt-3" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="mb-3">
                                <span class="text-danger">* </span><label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $participant->name }}" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="mb-3">
                                <span class="text-danger">* </span><label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $participant->email }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 col-md-3 col-lg-3">
                            <div class="mb-3">
                                <span class="text-danger">* </span><label class="form-label">Nilai X</label>
                                <input type="number" name="x" class="form-control" value="{{ $assessment->x }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-3 col-md-3 col-lg-3">
                            <div class="mb-3">
                                <span class="text-danger">* </span><label class="form-label">Nilai Y</label>
                                <input type="number" name="y" class="form-control" value="{{ $assessment->y }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-3 col-md-3 col-lg-3">
                            <div class="mb-3">
                                <span class="text-danger">* </span><label class="form-label">Nilai Z</label>
                                <input type="number" name="z" class="form-control" value="{{ $assessment->z }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-3 col-md-3 col-lg-3">
                            <div class="mb-3">
                                <span class="text-danger">* </span><label class="form-label">Nilai W</label>
                                <input type="number" name="w" class="form-control" value="{{ $assessment->w }}" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('home.participant.index') }}" class="btn btn-danger me-2"><i class="fas fa-times me-2"></i>Batal</a>
                        <button type="submit" class="btn btn-success text-white"><i class="far fa-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection