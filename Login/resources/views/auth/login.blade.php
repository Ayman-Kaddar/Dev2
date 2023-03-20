@extends('template.template')

@section('content')
    <div class="login-box">
        <div class="lb-header">
            <a href="#" class="active" id="login-box-link">Login</a>
            <a href="#" id="signup-box-link">Registrar</a>
        </div>
        <div class="social-login">
            <a href="{{route('login-github')}}">
                <i class="fa fa-facebook fa-lg"></i>
                Iniciar sesión con Facebook
            </a>
            <a href="{{route('login-google')}}">
                <i class="fa fa-google-plus fa-lg"></i>
                Iniciar sesión con Google
            </a>
        </div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <form class="email-login" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="u-form-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email_login') }}">
            </div>
            <div class="u-form-group">
                <input type="password" name="password" placeholder="Contraseña"/>
            </div>
            <div class="u-form-group">
                <button type="submit">Iniciar</button>
            </div>
            <div class="u-form-group">
                <a href="#" class="forgot-password hide">Forgot password?</a>
            </div>
        </form>
        <form class="email-signup hide" action="{{ route('register')}}" method="POST">
            @csrf
            <div class="u-form-group">
                <input type="text" name="name" placeholder="Nombre" value="{{ old('name_register') }}">
            </div>
            <div class="u-form-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email_register') }}" />
            </div>
            <div class="u-form-group">
                <input type="password" name="password" placeholder="Contraseña"/>
            </div>
            <div class="u-form-group">
                <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña"/>
            </div>
            <div class="u-form-group">
                <button type="submit">Registrar</button>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/authenticate.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/authenticate.js') }}"></script>
@endpush