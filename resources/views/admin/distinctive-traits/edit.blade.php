@extends('layouts.admin')

@section('title', 'Modifica Tratto Distintivo')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{ route('distinctive-traits.update', $distinctiveTrait) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="distinctive-trait-name" class="form-label fw-bold fs-5">Nome Tratto Distintivo</label>
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
@endsection
