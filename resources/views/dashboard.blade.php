@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row row-cols-1 row-cols-md-3 g-3">
            <div class="col d-flex">
                <div class="card bg-light flex-fill text-center p-4 shadow-sm">
                    <i class="bi bi-shop fs-1 text-danger"></i>
                    <h2>{{ __('Negozi') }}</h2>
                    <span class="fs-4">{{ $businessesCount }}</span>
                    <a href="{{ route('businesses.index') }}" class="btn-form-base btn-fill mx-auto my-2">Visualizza
                        Negozi</a>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card bg-light flex-fill text-center p-4 shadow-sm">
                    <i class="bi bi-folder2-open fs-1 text-danger"></i>
                    <h2>{{ __('Categorie') }}</h2>
                    <span class="fs-4">{{ $categoriesCount }}</span>
                    <a href="{{ route('categories.index') }}" class="btn-form-base btn-fill mx-auto my-2">Visualizza
                        Categorie</a>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card bg-light flex-fill text-center p-4 shadow-sm">
                    <i class="bi bi-tags fs-1 text-danger"></i>
                    <h2>{{ __('Tratti Distintivi') }}</h2>
                    <span class="fs-4">{{ $distinctiveTraitsCount }}</span>
                    <a href="{{ route('distinctive-traits.index') }}" class="btn-form-base btn-fill mx-auto my-2">Visualizza
                        Tratti Distintivi</a>
                </div>
            </div>
        </div>
    </div>
@endsection
