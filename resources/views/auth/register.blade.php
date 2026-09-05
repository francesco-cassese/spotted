@extends('layouts.guest')

@section('content')
    <div class="col-md-4 px-4">
        <div class="auth-card">
                    <x-logo />
                    <div class="auth-card-header fs-4">{{ __('Crea il tuo profilo') }}</div>

                    <div class="auth-card-subtitle fs-6">
                        <p>Unisciti ai network di scout e artigiani indipendenti</p>
                    </div>

                    <div class="auth-card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="my-2">
                                <label for="name" class="form-label auth-form-label">{{ __('Nome e Cognome') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-2">
                                <label for="email" class="form-label auth-form-label">{{ __('Indirizzo Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <div class="my-2">
                                    <label for="password" class="form-label auth-form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="my-2">
                                    <label for="password-confirm"
                                        class="form-label auth-form-label">{{ __('Conferma Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="mb-0 mt-3">
                                <button type="submit" class="btn-base btn-fill btn-block">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </form>
                    </div>
        </div>
    </div>
@endsection
