@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
@endsection

@section('dashboard-body-title', 'Apps')
@section('dashboard-body-desc', 'Hier finden Sie alle Apps')
@section('dashboard-content')
<div class="dashboard-content-menu">
    <a class="menu_item" href="{{ route('social_view', ['id' => auth()->user()->id]) }}">
        <div class="menu_item_header">
            <span class="menu_item_header_1 material-icons">groups</span>
            <span class="menu_item_header_2">Social Media</span>
            <span class="menu_item_header_3">Bearbeiten Sie Ihr Social Media Links</span>
        </div>
        <div class="menu_item_bottom">
            <span class="menu_item_bottom_1">Erfahre mehr</span>
            <span class="menu_item_bottom_2 material-icons">info_outlined</span>
        </div>
    </a>
    <a class="menu_item" href="">
        <div class="menu_item_header">
            <span class="menu_item_header_1 material-icons">location_on</span>
            <span class="menu_item_header_2">Google Maps</span>
            <span class="menu_item_header_3">Bearbeiten Sie Ihre Google Maps einstellung</span>
        </div>
        <div class="menu_item_bottom">
            <span class="menu_item_bottom_1">Erfahre mehr</span>
            <span class="menu_item_bottom_2 material-icons">info_outlined</span>
        </div>
    </a>
    <a class="menu_item" href="">
        <div class="menu_item_header">
            <span class="menu_item_header_1 material-icons">tag_faces</span>
            <span class="menu_item_header_2">Instagram API</span>
            <span class="menu_item_header_3">Bearbeiten Sie die Instagram API</span>
        </div>
        <div class="menu_item_bottom">
            <span class="menu_item_bottom_1">Erfahre mehr</span>
            <span class="menu_item_bottom_2 material-icons">info_outlined</span>
        </div>
    </a>
   <!-- <a class="menu_item" href="">
        <div class="menu_item_header">
            <span class="menu_item_header_1 material-icons">engineering</span>
            <span class="menu_item_header_2">Wartungs Arbeiten</span>
            <span class="menu_item_header_3">Bearbeiten Sie die Wartungsarbeiten</span>
        </div>
        <div class="menu_item_bottom">
            <span class="menu_item_bottom_1">Erfahre mehr</span>
            <span class="menu_item_bottom_2 material-icons">info_outlined</span>
        </div>
    </a>
    <a class="menu_item" href="">
        <div class="menu_item_header">
            <span class="menu_item_header_1 material-icons">cached</span>
            <span class="menu_item_header_2">Vorschau Animation</span>
            <span class="menu_item_header_3">Bearbeiten Sie die Vorschau</span>
        </div>
        <div class="menu_item_bottom">
            <span class="menu_item_bottom_1">Erfahre mehr</span>
            <span class="menu_item_bottom_2 material-icons">info_outlined</span>
        </div>
    </a> -->
</div>
@endsection
@section('script')
@endsection
