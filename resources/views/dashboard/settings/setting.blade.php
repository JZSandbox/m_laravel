@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
@endsection
@section('dashboard-body-title', 'Einstellungen')
@section('dashboard-body-desc', 'Hier sehen Sie alle Einstellungen')
@section('dashboard-content')
<div class="dashboard-content-menu">
    <a class="menu_item" href="{{ route('user_settings', ['id' => auth()->user()->id]) }}">
        <div class="menu_item_header">
            <span class="menu_item_header_1 material-icons">manage_accounts</span>
            <span class="menu_item_header_2">Account Einstellungen</span>
            <span class="menu_item_header_3">Bearbeiten Sie Ihr  Profile</span>
        </div>
        <div class="menu_item_bottom">
            <span class="menu_item_bottom_1">Erfahre mehr</span>
            <span class="menu_item_bottom_2 material-icons">info_outlined</span>
        </div>
    </a>
    <a class="menu_item" href="{{ route('company_settings', ['id' => $company->id]) }}">
        <div class="menu_item_header">
            <span class="menu_item_header_1 material-icons">apartment</span>
            <span class="menu_item_header_2">Firmen Einstellungen</span>
            <span class="menu_item_header_3">Bearbeiten Sie Ihre Firma</span>
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
