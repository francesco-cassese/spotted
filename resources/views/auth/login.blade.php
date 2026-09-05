@extends('layouts.guest')

@section('content')
    <div class="col-md-4 px-4">
        <div class="auth-card">
                    <x-logo />
                    <div class="auth-card-header fs-4">{{ __('Bentornato') }}</div>

                    <div class="auth-card-subtitle fs-6">
                        <p>Accedi al backoffice editoriale di Spotted</p>
                    </div>

                    <div class="auth-card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="my-2">
                                <label for="email" class="form-label auth-form-label">{{ __('Indirizzo Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-2">
                                <label for="password" class="form-label auth-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ricordami') }}
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Password dimenticata?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn-base btn-fill btn-block">
                                    {{ __('Accedi') }}
                                </button>
                            </div>
                        </form>
                    </div>
        </div>
    </div>
@endsection
