@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/table/index.css') }}">
@endsection
@section('dashboard-body-title', 'Kategorie Bearbeiten')
@section('dashboard-body-desc', 'Bearbeiten Sie, Ihre Kategorie')
@section('dashboard-content')
    <div class="dashboard-content-body-category" id="{{$categorys->category_title}}" data-reload-id="{{$categorys->category_title}}">
        <form action="{{route('category.save',['id' => $categorys->id])}}" method="post" enctype="multipart/form-data">
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
                                    <option value="0">Produkt Hinzufügen +</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_title }}</option>
                                    @endforeach
                                </select>
                                <div class="listProduct">
                                </div>
                            </div>
                            <div class="category-tabs-option">
                                <div class="category-tabs-option-title">
                                    <label for="category_title" class="tabs-input-label">Überschrift</label>
                                    <input type="text"  class="tabs-input-control" name="category_title" id="category_title" value="{{ $categorys->category_title }}">
                                </div>
                                <div class="category-option-textarea mt-2">
                                    <label for="category_description" class="tabs-input-label">Beschreibung</label>
                                    <textarea name="category_description" id="category_description" class="tabs-input-textarea">{{ $categorys->category_description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="category-tabs-content-gap"></div>
                        <div class="category-tabs-content-right">
                            <div class="category-tabs-addImage">
                                <div class="category-tabs-addImage-show">
                                    <p>Vorschaubild</p>
                                    <div class="category-tabs-addImage-preview">
                                        <img src="{{asset('img/customer/category/'.$categorys->category_preview_img)}}" id="categoryPreview" alt="Preview Pic - Category">
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
    <div class="hidden" data-category-id="{{$categorys->id}}"></div>
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            fetchProduct();
            $('#productsList').on("change", function (){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let productId = $(this).val();
                let categoryId = $('.hidden').data('category-id');
                let reloadId = $('.dashboard-content-body-category').data('reload-id');
                $.ajax({
                    url:'/dashboard/category/addCategoryRelation',
                    type:'POST',
                    data: {
                        productId : productId,
                        categoryId: categoryId,
                    },
                    success:function (response) {
                        $('#productsList').val('0')
                        success(response, iconObject.success, iconColor.success);
                        fetchProduct();
                    },
                    error: function (errors) {
                        console.log(errors)
                    }
                })
            })
        })
        function fetchProduct() {
            let categoryId = $('.hidden').data('category-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/category/ajax/'+categoryId,
                dataType: 'json',
                success: function (response){
                    $('.itemProduct').each(function (){
                        $('.itemProduct').remove();
                    })
                    $.each(response.success, function (key, item){
                        $('.listProduct').append('<div class="itemProduct position-relative">'+item.product_title+'<span class="material-icons delete_product" data-product-id='+item.id+'>delete</span></div>')
                    })
                    init();
                }
            })
        }
        function init() {
            $('.itemProduct').on("click", function (){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let productId = $(this).children('.delete_product').data('product-id');
                let categoryId = $('.hidden').data('category-id');
                let reloadId = $('.dashboard-content-body-category').data('reload-id');
                $.ajax({
                    url:'/public/dashboard/category/deleteRelation',
                    type:'POST',
                    data: {
                        productId : productId,
                        categoryId: categoryId,
                    },
                    success:function (response) {
                        success(response,iconObject.success,iconColor.success);
                        fetchProduct();
                    },
                    error: function (errors) {
                        console.log(errors)
                    }
                })
            });
        }
        picture_upload.onchange = evt => {
            const [file] = picture_upload.files
            console.log(file);
            if (file) {
                categoryPreview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
