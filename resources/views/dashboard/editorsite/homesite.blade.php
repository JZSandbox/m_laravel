@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/table/index.css') }}">
@endsection
@section('dashboard-body-title', 'Homepage Einstellungen')
@section('dashboard-body-desc', 'Bearbeiten Sie Ihre Homepage')
@section('dashboard-content')
    <div class="dashboard-content-body-category">
        <form action="{{route('site.homeedit', $homeSite->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="category-menu">
                <ul class="category-menu-list menu-left">
                    <li class="category-menu-item active">
                        <div  class="category-menu-link" data-tabs-menu="home">Inhalt</div>
                    </li>
                </ul>
                <ul class="category-menu-list menu-right">
                    <li class="category-menu-item">
                        <button type="submit" class="category-menu-link createCategory">
                            + Speichern
                        </button>
                    </li>
                </ul>
            </div>
            <div class="category-menu-tabs">
                <div class="category-tabs home show" aria-expanded="true">
                    <div class="category-tabs-content">
                        <div class="category-tabs-content-left">
                            <div class="category-tabs-option">
                                <div class="category-tabs-option-title">
                                    <label for="title" class="tabs-input-label">Überschrift</label>
                                    <input type="text"  class="tabs-input-control" name="title" id="title" value="{{$homeSite->title}}">
                                </div>
                                <div class="category-tabs-option-title">
                                    <label for="description" class="tabs-input-label">Beschreibung</label>
                                    <input type="text"  class="tabs-input-control" name="description" id="description" value="{{$homeSite->description}}">
                                </div>
                            </div>
                        </div>
                        <div class="category-tabs-content-gap"></div>
                        <div class="category-tabs-content-right">
                            <div class="category_tabs_content_right_container">
                                <div class="category_form_group space-between">
                                    <label for="preloader" class="tabs-input-label">Vorschau Lader Anzeigen</label>
                                    <input type="checkbox" id="preloader" name="preloader" @if($homeSite->preloader) checked value="1" @else value="0"@endif>
                                </div>
                                <div class="category_form_group space-between">
                                    <label for="wartungs" class="tabs-input-label">Wartungsarbeiten</label>
                                    <input type="checkbox" id="wartungs" name="wartungs" @if($homeSite->wartungs) checked value="1" @else value="0" @endif>
                                </div>
                                <div class="category_form_group space-between">
                                    <label for="togglePicture" class="tabs-input-label">Vorschaubild Deaktivieren</label>
                                    <input type="checkbox" id="togglePicture" name="togglePicture" @if($homeSite->image_toggle) checked value="1" @else value="0" @endif>
                                </div>
                                <div class="category-tabs-addImage @if($homeSite->image_toggle) picture-disabled @endif">
                                    <div class="category-tabs-addImage-show">
                                        <p>Vorschaubild</p>
                                        <div class="category-tabs-addImage-preview">
                                            <img src="{{asset('img/website/front/'.$homeSite->img_path)}}" id="homePagePreview" alt="Preview Pic - Category">
                                        </div>
                                    </div>
                                    <div class="category-tabs-addImage-btn">
                                        <label for="picture_upload" class="tabs-file-cstm">
                                            <span class="material-icons">file_upload</span>
                                            Bild Hochladen
                                        </label>
                                        <input type="file" name="picture_upload" class="tabs-file" id="picture_upload">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('change','#wartungs',function(){
            if($(this).is(':checked')){
                $('#wartungs').val(1);
            }else{
                $('#wartungs').val(0);
            }
        });
        $(document).on('change','#preloader',function(){
            if($(this).is(':checked')){
                $('#preloader').val(1);
            }else{
                $('#preloader').val(0);
            }
        });
        $(document).on('change', '#togglePicture', function() {
            if($(this).is(':checked')){
                $('#togglePicture').val(1);
                $('.category-tabs-addImage').addClass('picture-disabled');
            }else{
                $('#togglePicture').val(0);
                $('.category-tabs-addImage').removeClass('picture-disabled');
            }
        });
        picture_upload.onchange = evt => {
            const [file] = picture_upload.files
            console.log(file);
            if (file) {
                homePagePreview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
