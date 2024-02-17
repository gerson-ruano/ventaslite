@extends('layouts.theme.applogin')
{{--@extends('layouts.app') se usabe anteriormente--}}

@section('content')
<main role="main" class="container-fluid vh-100 d-flex justify-content-center align-items-center">
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center text-dark">{{config('app.name')}}</h4>
                <img class="img-fluid mx-auto d-block rounded" src="assets/img/ventaslite_logo.png"
                    alt="Logo de ventas">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="correo">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row mb-0 text-center">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    {{--<a href="#">Contraseña olvidada</a>--}}
                </form>
            </div>
        </div>
    </div>
</main>



{{--<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card ml-30" style="margin-top: 120px;">
                <div class="card-header text-center custom-color">
                    <h4 class="text-white">{{config('app.name')}}</h4>
</div>

<div class="card-body custom-color text-center">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <div class="d-grid text-center">
            <button type="submit" class="btn btn-blue">{{ __('Login') }}</button>
        </div>

        

        {{--@if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
        </a>
</div>
@endif--}}
</form>
</div>
</div>
</div>
</div>
</div>--}}
@endsection