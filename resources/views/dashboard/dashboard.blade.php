@extends('dashboard.master.master')
@section('dashboard-title', 'Acht | '.'Willkommen Herr '.Auth()->user()->forname)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css' )}}">
@endsection
@section('dashboard-body-title', 'Dashboard')
@section('dashboard-body-desc', 'Willkommen im Dashboard')
@section('dashboard-content')
@endsection
@section('script')
@endsection
