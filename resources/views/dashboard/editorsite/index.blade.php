@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
@endsection
@section('dashboard-body-title', 'Seiten Editor')
@section('dashboard-body-desc', 'Hier können Sie alle Einstellungen bezüglich Ihrer Hompage vornehmen')
@section('dashboard-content')
    <div class="dashboard-content-menu">
        <a class="menu_item" href="{{ route('site.home') }}">
            <div class="menu_item_header">
                <span class="menu_item_header_1 material-icons">home</span>
                <span class="menu_item_header_2">Home Seite</span>
                <span class="menu_item_header_3">Bearbeiten Sie Ihr Home Seite</span>
            </div>
            <div class="menu_item_bottom">
                <span class="menu_item_bottom_1">Erfahre mehr</span>
                <span class="menu_item_bottom_2 material-icons">info_outlined</span>
            </div>
        </a>
        <a class="menu_item" href="{{ route('site.about') }}">
            <div class="menu_item_header">
                <span class="menu_item_header_1 material-icons">business</span>
                <span class="menu_item_header_2">Über uns</span>
                <span class="menu_item_header_3">Bearbeiten Sie Ihre über uns Seite</span>
            </div>
            <div class="menu_item_bottom">
                <span class="menu_item_bottom_1">Erfahre mehr</span>
                <span class="menu_item_bottom_2 material-icons">info_outlined</span>
            </div>
        </a>
        <a class="menu_item" href="">
            <div class="menu_item_header">
                <span class="menu_item_header_1 material-icons">contacts</span>
                <span class="menu_item_header_2">Footer</span>
                <span class="menu_item_header_3">Bearbeiten Sie Ihre über uns Footer Seite</span>
            </div>
            <div class="menu_item_bottom">
                <span class="menu_item_bottom_1">Erfahre mehr</span>
                <span class="menu_item_bottom_2 material-icons">info_outlined</span>
            </div>
        </a>
    </div>
@endsection
@section('script')
@endsection
