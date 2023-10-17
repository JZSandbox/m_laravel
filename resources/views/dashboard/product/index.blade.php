@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/table/index.css') }}">
@endsection
@section('dashboard-body-title', 'Produkte')
@section('dashboard-body-desc', 'Hier finden Sie alle Produkte')
@section('dashboard-content')
<div class="dashboard-content-body-table">
<div class="row">
    <div class="col-3 offset-9">
        <div class="table-search">
            <input type="text" placeholder="Search...." class="table-search-input">
            <button type="submit" class="table-search-button">
                <span class="material-icons">search</span>
            </button>
        </div>
    </div>
</div>
<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Beschreibung</th>
        <th scope="col">Kategorien</th>
        <th scope="col" class="addField" data-bs-toggle="modal" data-bs-target="#createCategory">
            <a href="#" class="addField-link">+ Hinzufügen</a>
        </th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($products))
        @foreach($products as $product)
            <tr>
                <th scope="row">{{ $product->product_title }}</th>
                <td>{{ $product->product_desc }}</td>
                <td class="table-overflow-hidden">
                    <div class="dashboard-table-item"></div>
                </td>
                <td class="no_padding">
                    <div class="dashboard-table-option">
                        <a href="{{ route('product.edit', ['id' => $product->id])}}" class="dashboard-table-option-edit">Bearbeiten</a>
                        <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="dashboard-table-option-delete">Löschen</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    @else

    @endif
    </tbody>
</table>
{{ $products->links('vendor.pagination.custom') }}
</div>
<div class="modal fade achtModal" id="createCategory" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryLabel">Produkt </h5>
                <button type="button" class="acht-modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <form action="{{ route('product.create') }}" method="post">
                @csrf
            <div class="modal-body">
                <div class="form-block">
                    <label for="product_title" class="modal-label">Produkt Name</label>
                    <input type="text" name="product_title" class="modal-form-control" placeholder="Produkt Name">
                </div>
                <div class="form-block">
                    <label for="price_desc" class="modal-label">Produkt Beschreibung</label>
                    <textarea name="product_desc"  class="modal-form-control" id="product_desc" cols="5" rows="5" placeholder="Produkt Beschreibung......."></textarea>
                </div>
                <div class="form-block">
                    <label for="product_price" class="modal-label">Preis</label>
                    <input type="number" name="product_price" id="product_price" class="modal-form-control" placeholder="00,00€">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn acht-secondary" data-bs-dismiss="modal">Schließen</button>
                <button type="submit" class="btn acht-primary">Erstellen</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('.table-search-button').on("click", function(){
            let elem = $('.table-search-input').val();
            if(elem.length >= 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'/AchtCMS/public/dashboard/product/search',
                    type:'POST',
                    data: {
                        search : elem,
                    },
                    success:function (response) {
                        $('tbody').children().remove()
                        let html = "";
                       success(response,iconObject.success,iconColor.success)
                        for(let i = 0;i < response.data.length; i++) {
                            html += `
                                <tr>
                                    <th scope="row">${response.data[i].product_title}</th>
                                    <td>${response.data[i].product_desc}</td>
                                    <td class="table-overflow-hidden">
                                        <div class="dashboard-table-item"></div>
                                    </td>
                                    <td class="no_padding">
                                        <div class="dashboard-table-option">
                                            <a href="/dashboard/product/edit/${response.data[i].id}" class="dashboard-table-option-edit">Bearbeiten</a>
                                            <form action="/dashboard/product/delete/${response.data[i].id}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="dashboard-table-option-delete">Löschen</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                            `
                            $('tbody').html(html)
                        }
                    },
                    error: function (response) {

                    },
                })
            }
        })
    </script>
@endsection
