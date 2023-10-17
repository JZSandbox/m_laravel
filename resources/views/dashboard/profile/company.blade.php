@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | Firma Einstellungen')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
@endsection
@section('dashboard-body-title', 'Firma')
@section('dashboard-body-desc', 'Bearbeite die Firma')
@section('dashboard-content')

<form action="{{ route('company_settings_update', ['id' => $company->user_id ]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="user-profil">
        <div class="user-profil-box">
             <div class="user-profil-box-header">
                <div class="left">
                    <div class="drop_able_user_avater">
                        <label for="image_company" class="user_avater_upload"><span class="material-icons">file_upload</span></label>
                        <input type="file" name="image_company"" id="image_company" class="img_upload" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Klick, um dein Avatar zu ändern!">
                        @if(!empty($company->company_logo_folder))
                        <img src="{{ asset('img/company/logo/').'/'.$company->company_logo_folder }}" alt="Customer Logo" class="preview_picture" id="company_logo_profil">
                        @else
                        <img src="{{ asset('img/logo/logo-color.svg') }}" alt="Customer Logo" class="preview_picture" id="company_logo_profil">
                        @endif
                    </div>
                </div>
                <div class="spacer"></div>
                <div class="right">
                    <div class="form-block">
                        <label for="company" class="form-label">Firma</label>
                        <input type="text" class="form-control" name="company" value="{{ $company->company_name }}">
                    </div>
                    <div class="form-block">
                        <label for="company_owner" class="form-label">Inhaber</label>
                        <input type="text" class="form-control" name="company_owner" value="{{ $company->owner }}" readonly>
                    </div>
                </div>
            </div>
            <div class="user-profil-box-body mt-2">
                <div class="form-block">
                    <div class="grid-template-two">
                        <div class="first">
                            <label for="country" class="form-label">Land</label>
                            <input type="text" class="form-control" name="country" value="{{ $company->country }}" readonly>
                        </div>
                        <div class="space"></div>
                        <div class="secound">
                            <label for="state" class="form-label">Bundesland</label>
                            <input type="text" class="form-control" name="state" value="{{ $company->state }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-block">
                    <div class="grid-template-two">
                        <div class="first">
                            <label for="street" class="form-label">Straße</label>
                            <input type="text" class="form-control" name="street" value="{{ $company->address }}">
                        </div>
                        <div class="space"></div>
                        <div class="secound">
                            <label for="address_number" class="form-label">Hausnummer</label>
                            <input type="text" class="form-control" name="address_number" value="{{ $company->address_number }}">
                        </div>
                    </div>
                </div>
                <div class="form-block">
                    <div class="grid-template-two">
                        <div class="first">
                            <label for="zip" class="form-label">Postleitzahl</label>
                            <input type="text" class="form-control" name="zip" value="{{ $company->zip }}">
                        </div>
                        <div class="space"></div>
                        <div class="secound">
                            <label for="city" class="form-label">Stadt</label>
                            <input type="text" class="form-control" name="city" value="{{ $company->company_place}}">
                        </div>
                    </div>
                </div>
                <div class="form-block position-relative">
                    <label for="number" class="form-label phone_number">Telefon Nummer</label>
                    <input type="text" class="form-control phone_number_input" name="number" value="{{ $company->phone_number}}">
                    <span class="span_number">+49</span>
                </div>
            </div>
        </div>
    </div>
    <div class="button-profil-box">
        <a href="{{ url()->previous()  }}" class="btn btn-acht-submit">Zurück</a>
        <button type="submit" class="btn btn-acht-submit">Speichern</button>
    </div>
</form>
@endsection
@section('script')
    <script>
     $('#image_company').on("change", function(){
            let previewImage = $('#image_company')[0].files[0]
            if(previewImage) {
                company_logo_profil.src = URL.createObjectURL(previewImage);
                company_menu_logo.src = URL.createObjectURL(previewImage);
            }
        })
    </script>
@endsection
