@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | Profil Einstellungen')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
@endsection
@section('dashboard-body-title', 'Dein Profil')
@section('dashboard-body-desc', 'Berbeiter dein Profil')
@section('dashboard-content')
<form action="{{ route('user_settings_update', ['id' => auth()->user()->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="user-profil">
        <div class="user-profil-box">
             <div class="user-profil-box-header">
                <div class="left">
                    <div class="drop_able_user_avater">
                        <label for="image" class="user_avater_upload"><span class="material-icons">file_upload</span></label>
                        <input type="file" name="image" id="image" class="img_upload" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Klick, um dein Avatar zu ändern!">
                        @if(!empty($user->user_avater_folder))
                        <img src="{{ asset('img/customer/avatar/'.$user->user_avater_folder) }}" alt="Customer Logo" class="preview_picture" id="customer_avater_profil">
                        @else
                        <img src="{{ asset('img/logo/logo-color.svg') }}" alt="Customer Logo" class="preview_picture" id="customer_avater_profil">
                        @endif
                    </div>
                </div>
                <div class="spacer"></div>
                <div class="right">
                    <div class="form-block">
                        <label for="forname" class="form-label">Vorname</label>
                        <input type="text" class="form-control" name="forname" value="{{ $user->forname }}">
                    </div>
                    <div class="form-block">
                        <label for="name" class="form-label">Nachname</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>
                </div>
            </div>
            <div class="user-profil-box-body mt-2">
                <div class="form-block">
                    <label for="email" class="form-label">E-Mail</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                </div>
                <div class="form-block">
                    <label for="surename" class="form-label">Deine Role:</label>
                    <input type="text" class="form-control" name="surename" readonly value="User"
                    @if (auth()->user()->role == 2) value="User" @endif @if (auth()->user()->role == 3) value="Admin" @endif>
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
    <script>
     $('#image').on("change", function(){
            let previewImage = $('#image')[0].files[0]
            if(previewImage) {
                customer_avater_profil.src = URL.createObjectURL(previewImage);
                customer_avater_menu.src = URL.createObjectURL(previewImage);
            }
        })
    </script>
@endsection
