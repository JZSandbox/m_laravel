@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/table/index.css') }}">
@endsection
@section('dashboard-body-title', 'Produkt Erstellt')
@section('dashboard-body-desc', 'Bearbeiten Sie, Ihr Produkt')
@section('dashboard-content')
    <div class="dashboard-content-body-category" id="{{$product->category_title}}" data-reload-id="{{$product->category_title}}">
        <form action="{{route('category.save',['id' => $product->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="category-menu">
                <ul class="category-menu-list menu-left">
                    <li class="category-menu-item active">
                        <div  class="category-menu-link" data-tabs-menu="home">Inhalt</div>
                    </li>
                    <li class="category-menu-item">
                        <div class="category-menu-link" data-tabs-menu="details">Details</div>
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
                            <div class="category-tabs-addProduct">
                                <select id="productsList" class="tabs-select">
                                    <option value="0">Kategorie hinzufügen +</option>
                                </select>
                                <div class="listProduct">
                                </div>
                            </div>
                            <div class="category-tabs-option">
                                <div class="category-tabs-option-title">
                                    <label for="category_title" class="tabs-input-label">Überschrift</label>
                                    <input type="text"  class="tabs-input-control" name="category_title" id="category_title" value="{{ $product->product_title }}">
                                </div>
                                <div class="category-option-textarea mt-2">
                                    <label for="category_description" class="tabs-input-label">Beschreibung</label>
                                    <textarea name="category_description" id="category_description" class="tabs-input-textarea">{{ $product->product_desc }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="category-tabs-content-gap"></div>
                        <div class="category-tabs-content-right">
                            <div class="category-tabs-addImage">
                                <div class="category-tabs-addImage-show">
                                    <p>Vorschaubild</p>
                                    <div class="category-tabs-addImage-preview">
                                        <img src="" id="categoryPreview" alt="Preview Pic - Category">
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
                <div class="category-tabs details" aria-expanded="false">
                    test234
                </div>
            </div>
        </form>
    </div>
    <div class="hidden" data-product-id="{{$product->id}}"></div>
@endsection
@section('script')
@endsection
