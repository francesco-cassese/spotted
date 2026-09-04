@extends('layouts.admin')

@section('title', 'Modifica Tratto Distintivo')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <a href="{{ route('distinctive-traits.index') }}" class="btn btn-link ps-0 text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Torna ai tratti distintivi
                    </a>
                    <h1 class="fs-4 mb-0">Modifica Tratto Distintivo</h1>
                </div>

                <div class="card shadow-sm bg-light">
                    <div class="card-body py-3">
                        <form action="{{ route('distinctive-traits.update', $distinctiveTrait) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-2">
                                <label for="distinctive-trait-name" class="form-label fw-bold fs-5">Nome Tratto
                                    Distintivo</label>
                                <input type="text" name="name" id="distinctive-trait-name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Es. Fatto a mano"
                                    value="{{ old('name', $distinctiveTrait->name) }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn-form-base btn-login">Modifica</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
