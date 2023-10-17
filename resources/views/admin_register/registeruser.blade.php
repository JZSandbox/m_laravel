@extends('admin_login/master/layout')
@section('title', 'Acht | Regristrieren')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_register/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_login/index.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection
@section('body')
    @if(session('error'))
        <div class="notification-area">
            <div class="notification noti-error mb-3">
            <div class="noti-left">
                <span class="material-icons">error</span>
            </div>
            <div class="noti-right">
                <div class="noti-right-top">
                    <span>Fehler!</span>
                </div>
                <div class="noti-right-bottom">
                    {{session('error')}}
                </div>
            </div>
        </div>
        </div>
    @endif
    @if(session('success'))
        <div class="notification noti-success mb-3">
            <div class="noti-left">
                <span class="material-icons">check_circle</span>
            </div>
            <div class="noti-right">
                <div class="noti-right-top">
                    <span>Erfolg!</span>
                </div>
                <div class="noti-right-bottom">
                    Lorem ipsum dolor sit amet.
                </div>
            </div>
        </div>
    @endif
    @if(session('info'))
        <div class="notification-area">
            <div class="notification noti-update mb-3">
            <div class="noti-left">
                <span class="material-icons">tips_and_updates</span>
            </div>
            <div class="noti-right">
                <div class="noti-right-top">
                    <span>Info !</span>
                </div>
                <div class="noti-right-bottom">
                    {{ session('info') }}
                </div>
            </div>
        </div>
        </div>
    @endif
    <section id="register">
        <div class="register">
            <div class="register-left">
                <img src="{{asset('img/admin_login/logo-white.svg')}}" alt="Acht Logo - Color">
            </div>
            <div class="register-right">
                <div class="register-right-content">
                    <div class="register-right-title">
                        <div class="top">
                            <h1>Erstellen Sie, Ihren Account</h1>
                        </div>
                        <div class="bottom">
                            <p>Schon einen Account Erstellt?</p>
                            <a href="{{ route('login') }}" class="link link-acht-blue">Login</a>
                        </div>
                    </div>
                    <form action="{{ route('register_user') }}" method="post">
                        @csrf
                        <div class="register-right-body">
                            <div class="form-grid mb-2">
                                <div class="form-block">
                                    <label for="surename" class="form-label">Vorname</label>
                                    <input type="text" class="form-control @error('surename') register_user_error-b @enderror" id="surename" name="surename" placeholder="Vorname" >
                                    @error('surename')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                                <div class="form-block">
                                    <label for="name" class="form-label">Nachname</label>
                                    <input type="text" class="form-control @error('name') register_user_error-b @enderror" id="name" name="name" placeholder="Nachname">
                                    @error('name')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-grid mb-2">
                                <div class="form-block">
                                    <label for="email" class="form-label">E-Mail</label>
                                    <input type="text" class="form-control @error('email') register_user_error-b @enderror" id="email" name="email" placeholder="E-Mail">
                                    @error('email')
                                        <span class="register_user_error">E-Mail bereits verwendet.</span>
                                    @enderror
                                </div>
                                <div class="form-block">
                                    <label for="email_confirmation" class="form-label">E-Mail wiederholen</label>
                                    <input type="text" class="form-control @error('email') register_user_error-b @enderror" id="email_confirmation" name="email_confirmation" placeholder="E-Mail wiederholen">
                                    @error('email')
                                        <span class="register_user_error">E-Mail bereits verwendet.</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-grid mb-2">
                                <div class="form-block">
                                    <label for="password" class="form-label">Passwort</label>
                                    <input type="password" class="form-control @error('password') register_user_error-b @enderror" id="password" name="password" placeholder="Passwort">
                                    @error('password')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                                <div class="form-block">
                                    <label for="password_confirmation" class="form-label">Passwort wiederholen</label>
                                    <input type="password" class="form-control @error('password') register_user_error-b @enderror" id="password_confirmation" name="password_confirmation" placeholder="Passwort wiederholen">
                                    @error('password')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-block">
                                <label for="auth_key" class="form-label">Authentifikationsschlüssel</label>
                                <input type="text" class="form-control @error('auth_key') register_user_error-b @enderror" id="auth_key" name="auth_key" placeholder="Authentifikationsschlüssel">
                            </div>
                        </div>
                        <div class="register-right-link">
                            <button type="submit" class="btn btn-acht-action d-block">
                                Account erstellen
                            </button>
                        </div>
                        @if(session('message'))
                            <p>{{session('message')}}</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('admin_login/master/script')
@endsection
