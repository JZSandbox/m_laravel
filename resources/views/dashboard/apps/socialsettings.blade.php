@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | Profil Einstellungen')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
@endsection
@section('dashboard-body-title', 'Social Media Einstellungen')
@section('dashboard-body-desc', 'Links einstellen')
@section('dashboard-content')
<form action="{{ route('social_update', ['id' => $socials->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="user-profil">
        <div class="user-profil-box">
            <div class="user-profil-box-body mt-2">
                <div class="form-block">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" class="form-control" name="instagram" value="{{ $socials->instagram }}">
                </div>
                <div class="form-block">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="{{ $socials->facebook }}">
                </div>
                <div class="form-block">
                    <label for="whatsapp" class="form-label">Whatsapp</label>
                    <input type="number phone_number" class="form-control" name="whatsapp" value="{{ $socials->whatsapp}}">
                </div>
            </div>
        </div>
    </div>
    <div class="button-profil-box">
        <a href="{{ url()->previous() }}" class="btn btn-acht-submit">Zurück</a>
        <button type="submit" class="btn btn-acht-submit">Speichern</button>
    </div>
</form>
@endsection
@section('script')
@endsection
