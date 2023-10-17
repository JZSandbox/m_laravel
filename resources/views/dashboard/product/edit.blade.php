@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/table/index.css') }}">
@endsection
@section('dashboard-body-title', 'Produkt Bearbeiten')
@section('dashboard-body-desc', 'Bearbeiten Sie, Ihr Produkt')
@section('dashboard-content')
 <div class="dashboard-content-body-category" id="{{$product->product_title}}" data-reload-id="{{$product->category_title}}">
            <form action="{{route('product.save',['id' => $product->id])}}" method="post" enctype="multipart/form-data">
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
                                        <option value="0">Kategorie Hinzufügen +</option>
                                        @foreach($categorys as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="listProduct">
                                    </div>
                                </div>
                                <div class="category-tabs-option">
                                    <div class="category-tabs-option-title">
                                        <label for="product_title" class="tabs-input-label">Überschrift</label>
                                        <input type="text"  class="tabs-input-control" name="product_title" id="category_title" value="{{ $product->product_title }}">
                                    </div>
                                    <div class="category-option-textarea mt-2">
                                        <label for="product_desc" class="tabs-input-label">Beschreibung</label>
                                        <textarea name="product_desc" id="product_desc" class="tabs-input-textarea">{{ $product->product_desc }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="category-tabs-content-gap"></div>
                            <div class="category-tabs-content-right">
                                <div class="category-tabs-addImage">
                                    <div class="category-tabs-addImage-show">
                                        <p>Vorschaubild</p>
                                        <div class="category-tabs-addImage-preview">
                                            <img src="{{asset('img/customer/product/'.$product->product_preview_img)}}" id="categoryPreview" alt="Preview Pic - Category">
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
                        <div class="category-tabs-option-title">
                            <label for="product_price" class="tabs-input-label">Preis:</label>
                            <input type="number"  class="tabs-input-control" name="product_price" id="category_title" value="{{ $product->product_price}}">
                        </div>
                    </div>
                </div>
            </form>
    </div>
    <div class="hidden" data-product-id="{{$product->id}}"></div>
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
            let categoryId = $(this).val();
            let productId = $('.hidden').data('product-id');
            $.ajax({
                url:'/dashboard/product/addProductRelations',
                type:'POST',
                data: {
                    productId : productId,
                    categoryId: categoryId,
                },
                success:function (response) {
                    $('#productsList').val('0')
                    success(response, iconObject.success, iconColor.success);
                    fetchProduct()
                },
                error: function (errors) {
                    console.log(errors)
                }
            })
        })
    })
    function fetchProduct() {
        let productId = $('.hidden').data('product-id');
        $.ajax({
            type: 'GET',
            url: '/dashboard/product/ajax/'+productId,
            dataType: 'json',
            success: function (response){
                console.log(response.data)
                $('.itemProduct').each(function (){
                    $('.itemProduct').remove();
                })
                $.each(response.data, function (key, item){
                    $('.listProduct').append('<div class="itemProduct position-relative">'+item.category_title+'<span class="material-icons delete_category delete_product" data-category-id='+item.id+'>delete</span></div>')
                })
            }
        })
    }

        $(document).on("click", ".itemProduct", function (){
            console.log("clicked")
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let productId = $('.hidden').data('product-id');
            let categoryId = $(this).children('.delete_category').data('category-id');
            let reloadId = $('.dashboard-content-body-category').data('reload-id');
            $.ajax({
                url:'/public/dashboard/product/deleteProductRelations',
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

    picture_upload.onchange = evt => {
        const [file] = picture_upload.files
        console.log(file);
        if (file) {
            categoryPreview.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection
