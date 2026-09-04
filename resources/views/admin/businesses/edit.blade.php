@extends('layouts.admin')

@section('title', 'Modifica Negozio')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <a href="{{ route('businesses.index') }}" class="btn btn-link ps-0 text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Torna ai negozi
                    </a>
                    <h1 class="fs-4 mb-0">Modifica Negozio</h1>
                </div>

                <div class="card shadow-sm bg-light">
                    <div class="card-body py-3">
                        <form action="{{ route('businesses.update', $business) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12 col-sm-4 mb-2">
                                    <label for="business-name" class="form-label fw-bold fs-5">Nome</label>
                                    <input type="text" name="name" id="business-name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Es. Bottega del Sapone" value="{{ old('name', $business->name) }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-4 mb-2">
                                    <label for="business-address" class="form-label fw-bold fs-5">Indirizzo</label>
                                    <input type="text" name="address" id="business-address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address', $business->address) }}">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-4 mb-2">
                                    <label for="business-contact" class="form-label fw-bold fs-5">Contatti</label>
                                    <input type="text" name="contact" id="business-contact"
                                        class="form-control @error('contact') is-invalid @enderror"
                                        value="{{ old('contact', $business->contact) }}">

                                    @error('contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6 mb-2">
                                    <label for="business-category" class="form-label fw-bold fs-5">Categoria</label>
                                    <select name="category_id" id="business-category"
                                        class="form-select @error('category_id') is-invalid @enderror">
                                        <option value="">Seleziona una categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @selected(old('category_id', $business->category_id) == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-6 mb-2">
                                    <label for="business-cover-image" class="form-label fw-bold fs-5">Immagine di
                                        copertina</label>
                                    <input type="file" name="cover_image" id="business-cover-image"
                                        class="form-control @error('cover_image') is-invalid @enderror">

                                    @error('cover_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="business-story" class="form-label fw-bold fs-5">Storia</label>
                                <textarea name="story" id="business-story" rows="2" class="form-control @error('story') is-invalid @enderror">{{ old('story', $business->story) }}</textarea>

                                @error('story')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label fw-bold fs-5">Tratti distintivi</label>

                                <div class="form-control mb-3 d-flex flex-wrap">
                                    @foreach ($distinctiveTraits as $trait)
                                        <div class="trait me-2">
                                            <input type="checkbox" name="distinctive_traits[]" value="{{ $trait->id }}"
                                                id="trait-{{ $trait->id }}"
                                                {{ $business->distinctiveTraits->contains($trait->id) ? 'checked' : '' }}>
                                            <label for="trait-{{ $trait->id }}">{{ $trait->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                @error('distinctive_traits')
                                    <span class="invalid-feedback d-block" role="alert">
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
