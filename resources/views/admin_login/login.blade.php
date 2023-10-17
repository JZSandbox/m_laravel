@extends('admin_login.master.layout')
@section('title', 'Acht | Login')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_login/index.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection
@section('body')
    <section id="loginMain">
        <div class="login-body">
            <div class="login-left">
                <div class="login-block">
                    <div class="login-block-logo">
                        <img src="{{asset('img/admin_login/logo-color.svg')}}" alt="Acht Logo - Color">
                    </div>
                    <form action="{{ route('adminlogin') }}" method="post">
                        @csrf
                        <div class="login-block-body">
                            <div class="form-block position-relative">
                                <label for="email" class="form-label">E-Mail</label>
                                <input type="email" id="email" name="email" class="form-control @error('email')form-control-error @enderror">
                                @error('email')
                                    <span class="login-error-message">Feld muss ausgefüllt werden.</span>
                                @enderror
                            </div>
                            <div class="form-block position-relative">
                                <label for="password" class="form-label">Passwort</label>
                                <input type="password" id="password" name="password" class="form-control @error('password')form-control-error @enderror">
                                @error('password')
                                    <span class="login-error-message">Feld muss ausgefüllt werden.</span>
                                @enderror
                            </div>
                            <div class="form-submit-block">
                                <button type="submit" class="d-block btn btn-acht-action" value="submit">
                                    Einloggen
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="login-block-option">
                        <span class="option-span">Optionen</span>
                    </div>
                    <div class="login-block-option-buttons">
                        <a href="{{ route('register') }}" class="d-block btn btn-acht-action">
                            Registrieren
                        </a>
                        <button type="button" class="password-reset mt-3" data-bs-toggle="modal" data-bs-target="#forgotPassword">Passwort vergessen?</button>
                    </div>
                </div>
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
                    <div class="notification-area">
                     <div class="notification noti-success mb-3">
                        <div class="noti-left">
                            <span class="material-icons">check_circle</span>
                        </div>
                        <div class="noti-right">
                            <div class="noti-right-top">
                                <span>Erfolg!</span>
                            </div>
                            <div class="noti-right-bottom">
                                {{ session('success') }}
                            </div>
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
            </div>
            <div class="login-right">
                <div class="logo-white">
                    <img src="{{ asset('img/admin_login/logo-white.svg') }}" alt="Acht Logo - White">
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="forgotPassword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordHeader">Passwort wiederherstellen</h5>
                    <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="passwordReset" class="form-label mb-1">E-Mail</label>
                    <input type="email" id="passwordReset" class="form-control" placeholder="E-Mail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-acht-action" data-bs-dismiss="modal">Zurück</button>
                    <button type="button" class="btn btn-acht-action">Senden</button>
                </div>
            </div>
        </div>
    </div>
    @include('admin_login/master/script')
@endsection
