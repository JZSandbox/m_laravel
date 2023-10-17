@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/table/index.css') }}">
@endsection
@section('dashboard-body-title', 'Über uns Einstellungen')
@section('dashboard-body-desc', 'Bearbeiten Sie Ihre Über uns Seite')
@section('dashboard-content')
    <div class="dashboard-content-body-category">
        <form action="{{route('site.aboutedit', $aboutSite->id)}}" method="post" enctype="multipart/form-data">
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
                            <div class="category-tabs-option" style="height: 100% !important;">
                                <div class="category-tabs-option-title">
                                    <label for="big_title" class="tabs-input-label">Überschrift</label>
                                    <input type="text"  class="tabs-input-control" name="big_title" id="big_title" value="{{$aboutSite->big_title}}">
                                </div>
                                <div class="category-tabs-option-title">
                                    <label for="small_title" class="tabs-input-label">Beschreibung</label>
                                    <input type="text"  class="tabs-input-control" name="small_title" id="small_title" value="{{$aboutSite->small_title}}">
                                </div>
                                <div class="category-tabs-option-title">
                                    <label for="text_1" class="tabs-input-label">Transparenz</label>
                                    <input type="text"  class="tabs-input-control" name="text_1" id="text_1" value="{{$aboutSite->text_1}}">
                                </div>
                                <div class="category-tabs-option-title">
                                    <label for="text_2" class="tabs-input-label">Experten</label>
                                    <input type="text"  class="tabs-input-control" name="text_2" id="text_2" value="{{$aboutSite->text_2}}">
                                </div>
                                <div class="category-tabs-option-title">
                                    <label for="text_3" class="tabs-input-label">Vetrauen</label>
                                    <input type="text"  class="tabs-input-control" name="text_3" id="text_3" value="{{$aboutSite->text_3}}">
                                </div>
                            </div>
                        </div>
                        <div class="category-tabs-content-gap"></div>
                        <div class="category-tabs-content-right">


                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
