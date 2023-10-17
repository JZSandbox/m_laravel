@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/table/index.css') }}">
@endsection
@section('dashboard-body-title', 'Kategorien')
@section('dashboard-body-desc', 'Hier bekommen Sie einen überblick')
@section('dashboard-content')
<div class="dashboard-content-body-table">
<div class="row">
    <div class="col-3 offset-9">
        <div class="table-search">
            <input type="text" name="search" placeholder="Search...." class="table-search-input">
            <button type="submit" class="table-search-button">
                <span class="material-icons">search</span>
            </button>
        </div>
    </div>
</div>
<table class="table table-sm" id="categoryOrder">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Beschreibung</th>
        <th scope="col">Produkte</th>
        <th scope="col" class="addField" data-bs-toggle="modal" data-bs-target="#createCategory">
            <a href="#" class="addField-link">+ Hinzufügen</a>
        </th>
    </tr>
    </thead>
    <tbody class="searchInsert">
    @if(!empty($categorys))
     @foreach($categorys as $category)
    <tr class="searchInsert" data-id="{{$category->id}}">
        <th scope="row">{{ $category->category_title }}</th>
        <td>{{ $category->category_description }}</td>
        <td class="table-overflow-hidden">
            @foreach($categoryRelation as $cR)
                @if($category->id == $cR->id)
                    @foreach($cR->product as $cP)
                        <div class="dashboard-table-item">{{$cP->product_title}}</div>
                    @endforeach
                @endif
            @endforeach
        </td>
        <td class="no_padding">
            <div class="dashboard-table-option">
                <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="dashboard-table-option-edit">Bearbeiten</a>
                <form action="{{ route('category.delete',['id' => $category->id]) }}" method="POST">
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
{{ $categorys->links('vendor.pagination.custom') }}
</div>
<div class="modal fade achtModal" id="createCategory" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryLabel">Kategorie erstellen</h5>
                <button type="button" class="acht-modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <form action="{{ route('category.create') }}" method="post">
                @csrf
            <div class="modal-body">
                <div class="form-block">
                    <label for="category_title" class="modal-label">Kategorie Name</label>
                    <input type="text" name="category_title" class="modal-form-control" placeholder="Kategorie Name">
                </div>
                <div class="form-block">
                    <label for="category_desc" class="modal-label">Kategorie Beschreibung</label>
                    <textarea name="category_desc"  class="modal-form-control" id="category_desc" cols="5" rows="5" placeholder="Kategorie Beschreibung......."></textarea>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.table-search-button').on("click", function () {
            console.log("clicked");
            let searchString = $('.table-search-input').val();
            $.ajax({
                url: '/dashboard/category/search',
                type: 'POST',
                data: {
                    search: searchString
                },
                success:function (response) {
                    console.log(response)
                    success(response,iconObject.success, iconColor.success)
                    var searchResult = "";
                    $('.searchInsert').children().remove();
                    for(let i = 0; i < response.data.length; i++) {
                        searchResult += `<tr class="column">
                        <th scope="row">${response.data[i].category_title}</th>
                              <td>${response.data[i].category_description}</td>
                              <td class="table-overflow-hidden">
                                      <div class="dashboard-table-item"></div>
                              </td>
                             <td class="no_padding">
                                    <div class="dashboard-table-option">
                                    <a href="/AchtCMS/public/dashboard/category/${response.data[i].id}" class="dashboard-table-option-edit">Bearbeiten</a>
                                    <form action="/AchtCMS/public/dashboard/category/delete/${response.data[i].id}" method="POST">
                                       <button type="submit" class="dashboard-table-option-delete">Löschen</button>
                                   </form>
                                    </div>
                               </td>
                        </tr>`
                        $('.searchInsert').html(searchResult);
                    }
                },
                error: function (errors) {
                    console.log(errors)
                }

            })
        })
        $(function (){
            $('.searchInsert').sortable({
                items: "tr",
                cursor: "move",
                opacity: "0",
                update: function() {
                    sendOrderToServer();
                }
            })
            function sendOrderToServer() {
                var order = [];
                $('tr.searchInsert').each(function(index, element) {
                  order.push({
                      id: $(this).attr('data-id'),
                      position: index+1
                  })
                })
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "/dashboard/category/newOrder",
                    data: {
                        order:order,
                    },
                    success: function (response){
                        console.log(response)
                        success(response,iconObject.success,iconColor.success)
                    }
                })
            }
        })
    </script>
@endsection
