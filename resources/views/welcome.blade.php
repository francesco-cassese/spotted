@extends('layouts.app')

@section('content')
    <div class="logo logo-xxl">
        <x-logo />
    </div>
    <div class="welcome-subtitle">
        <p>Una guida curata alle attività commerciali indipendenti e alle botteghe artigiane del territorio.</p>
    </div>
    <div class="welcome-actions d-flex">
        <a class="btn-base btn-login" href="{{ route('login') }}">{{ __('Login') }}</a>
        <a class="btn-base btn-register" href="{{ route('register') }}">{{ __('Register') }}</a>
    </div>
@endsection
