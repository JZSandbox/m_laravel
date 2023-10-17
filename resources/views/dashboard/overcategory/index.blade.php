@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/table/index.css') }}">
@endsection
@section('dashboard-body-title', 'Über Kategorien')
@section('dashboard-body-desc', 'Hier bekommen Sie einen überblick')
@section('dashboard-content')

<div class="over_category">
    <div class="btn-add-category" data-bs-toggle="modal" data-bs-target="#createOverCategory">Erstellen</div>
</div>
<div class="over_category_c">
    @foreach ($categorys as $category)
    <div class="over_category_container">
        <div class="over_category_container_name">
            {{ $category->name }}
        </div>
        <div class="over_category_options">
            <div class="over_category_options_delete" data-delete-id="{{ $category->id }}">
                Löschen
            </div>
            <div class="over_category_options_settings" data-id="{{ $category->id }}" data-bs-toggle="modal" data-bs-target="#getSettings">
                Bearbeiten
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Create Modal -->
<div class="modal" id="createOverCategory" tabindex="-1" aria-labelledby="createCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Erstelle eine überkategorie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="name_create" id="name_create" placeholder="name">
          <select name="categories" id="categorys_create">
              <option value="0">Select</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary create">Erstellen</button>
        </div>
      </div>
    </div>
  </div>

<!-- Update Modal -->
<div class="modal" id="getSettings" tabindex="-1" aria-labelledby="getSettings" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" id="name" placeholder="name">
          <select name="categories" id="categorys">
              <option value="0">Select</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
          <button type="button" class="btn btn-primary update">Update</button>
        </div>
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
     /** Overcategory Settings **/
    $(document).on("click", ".over_category_options_settings", function () {
        let id = $(this).data('id')
        let categories = $('#categorys');
        categories.html("")
        $.ajax({
            url: 'overcategory/getData',
            type: 'POST',
            data: {
                id : id
            },
            success: function(response) {
                let data = response.category
                let category = response.allCategory
                $('#getSettings').find('.modal-title').html(data.name)
                $('#getSettings').find('#name').val(data.name)
                $('#getSettings').find('.btn-primary').attr('data-id', data.id)
                Object.keys(category).map(function(i,value) {
                    if(category[i].over_categories_id == id) {
                        let html = `<option value="${category[i].id}" selected="true">${category[i].category_title}</option>`
                        categories.append(html)
                    } else {
                        let html = `<option value="${category[i].id}">${category[i].category_title}</option>`
                        categories.append(html)
                    }
                })
            }
        })
     })

     /** Overcategory Update **/
     $(document).on("click", ".update", function(){
        let name = $('#name').val()
        let id = $(this).attr('data-id')
        let select = $('#categorys').val()
        $.ajax({
            url:'overcategory/updateData',
            type: 'POST',
            data: {
                name: name,
                select: select,
                id: id
            },
            success: function(response) {
                location.reload()
            }
         })
     })

     /** Create **/
     $(document).on("click", ".btn-add-category", function(){
        $('#categorys_create').html("")
        $.ajax({
            url:'overcategory/createData',
            type:'POST',
            data: {},
            success: function (response) {
                let select = $('#categorys_create')
                let data = response.data
                Object.keys(data).map(function(i,element) {
                    if(data[i].over_categories_id == 0) {
                        let html = `<option value="${data[i].id}" selected="true">${data[i].category_title}</option>`
                        select.append(html)
                    }
                })
            }
        })
     })

     /** Overcategory Delete **/
     $(document).on("click", ".over_category_options_delete", function () {
        let id = $(this).data("delete-id")
        $.ajax({
            url:'overcategory/deleteData',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                location.reload()
            }
        })
    })

    /** Overcategory Creation **/
    $(document).on("click", ".create", function(){
        let name = $('#name_create').val()
        let select = $('#categorys_create').val()
        $.ajax({
            url:'overcategory/createNew',
            type:'POST',
            data: {
                name : name,
                select : select,
            },
            success: function(response) {
                location.reload()
            }
        })
    })
</script>
@endsection
