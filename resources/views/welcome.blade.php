@extends('layouts.guest')

@section('content')
    <div class="col-md-6 px-4 text-center">
        <div class="logo logo-xxl">
            <x-logo />
        </div>
        <div class="welcome-subtitle">
            <p class="fs-5">Una guida curata alle attività commerciali indipendenti e alle botteghe artigiane del territorio.</p>
        </div>
        <div class="welcome-actions d-flex justify-content-center">
            <a class="btn-base btn-login" href="{{ route('login') }}">{{ __('Accedi') }}</a>
            <a class="btn-base btn-register" href="{{ route('register') }}">{{ __('Registrati') }}</a>
        </div>
    </div>
@endsection
