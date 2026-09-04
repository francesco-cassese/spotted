@extends('layouts.admin')

@section('title', ' Modifica Categoria')

@section('content')

    <div class="row">
        <div class="col-12 col-md-6">
            <a href="{{ route('categories.index') }}" class="btn btn-link ps-0 mb-3 text-decoration-none">
                <i class="bi bi-arrow-left"></i> Torna alle categorie
            </a>

            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category-name" class="form-label fw-bold fs-5">Nome categoria</label>
                    <input type="text" name="name" id="category-name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Es. Artigianato"
                        value="{{ old('name', $category->name) }}">

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
