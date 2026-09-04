@extends('layouts.admin')

@section('title', 'Nuovo Tratto distintivo')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{ route('distinctive-traits.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="distinctive-trait-name" class="form-label fw-bold fs-5">Nome Tratto Distintivo</label>
                    <input type="text" name="name" id="distinctive-trait-name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Es. Fatto a mano"
                        value="{{ old('name') }}">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn-form-base btn-login">Aggiungi</button>
            </form>
        </div>
    </div>
@endsection
