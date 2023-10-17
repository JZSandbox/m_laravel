@extends('admin_login/master/layout')
@section('title', 'Acht | Regristrieren')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_register/company/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_login/index.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection
@section('body')
    <section id="register_company">
        <div class="register">
            <div class="register-left">
                <img src="{{asset('img/admin_login/logo-white.svg')}}" alt="Acht Logo - Color">
            </div>
            <div class="register-right position-relative">
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
                <div class="register-right-content">
                    <div class="register-right-title">
                        <div class="top">
                            <h1>Erstellen Sie, Ihr Unternehmen</h1>
                        </div>
                        <div class="bottom">
                            <p>Nicht Ihr Account?</p>
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="link link-acht-blue">Logout</button>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('register_user_company') }}" method="post">
                       @csrf
                        <div class="register-right-body">
                            <div class="form-grid mb-2">
                                <div class="form-block">
                                    <label for="company_name" class="form-label">Firmen Name</label>
                                    <input type="text" class="form-control @error('company_name') register_user_error-b @enderror" id="company_name" name="company_name" placeholder="Firmen Name" value="{{old('company_name')}}">
                                    @error('company_name')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                                <div class="form-block">
                                    <label for="company_owner" class="form-label">Inhaber</label>
                                    <input type="text" class="form-control  @error('company_owner') register_user_error-b @enderror" id="company_owner" name="company_owner" placeholder="Inhaber">
                                    @error('company_owner')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-grid mb-2">
                                <div class="form-block">
                                    <label for="country" class="form-label">Land</label>
                                    <select name="country" id="country" class="form-control @error('country') register_user_error-b @enderror">
                                        <option value="0">Land wählen..</option>
                                        <option value="germany">Deutschland</option>
                                    </select>
                                    @error('country')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                                <div class="form-block">
                                    <label for="company_state" class="form-label">Bundesland</label>
                                    <select name="company_state" id="company_state" class="form-control @error('company_state') register_user_error-b @enderror">
                                        <option value="0">Bundesland wählen..</option>
                                        <option value="nrw">NRW</option>
                                    </select>
                                    @error('company_state')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-grid mb-2">
                                <div class="form-block">
                                    <label for="company_address" class="form-label">Addresse</label>
                                    <input type="text" class="form-control  @error('company_address') register_user_error-b @enderror" name="company_address" id="company_address" placeholder="Addresse">
                                    @error('company_address')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                                <div class="form-block">
                                    <label for="zip" class="form-label">Hausnummer</label>
                                    <input type="text" class="form-control @error('zip') register_user_error-b @enderror" id="zip" name="zip" placeholder="Hausnummer">
                                    @error('zip')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-grid mb-2">
                                <div class="form-block">
                                    <label for="company_place" class="form-label">Ort</label>
                                    <input type="text" class="form-control @error('company_place') register_user_error-b @enderror" id="company_place" name="company_place" placeholder="Ort">
                                    @error('company_place')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                                <div class="form-block">
                                    <label for="zip_code" class="form-label">Postleitzahl</label>
                                    <input type="number" class="form-control @error('zip_code') register_user_error-b @enderror" id="zip_code" name="zip_code" placeholder="Postleitzahl">
                                    @error('zip_code')
                                        <span class="register_user_error">Bitte das Feld ausfüllen</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-block position-relative">
                                <label for="company_number" class="form-label">Telefonnummer</label>
                                <input type="number" class="form-control form-number @error('company_number') register_user_error-b @enderror" name="company_number" id="company_number" placeholder="Nummer">
                                <div class="input-number">+49</div>
                            </div>
                        </div>
                        <div class="register-right-link">
                            <button type="submit" class="btn btn-acht-action d-block">
                                Unternehmen erstellen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('admin_login/master/script')
@endsection
