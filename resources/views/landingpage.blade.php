@extends('layouts.app')

@section('title', 'DESA DALISODO')

@section('navbar')
    @include('components.navbar')
@endsection
@section('content')
    @include('components.header')
    @include('components.tentang')
    @include('components.potensi')
    @include('components.berita')
    @include('components.perangkat')
    @include('components.lokasi')
    @include('components.backToTop')
@endsection
@section('footer')
    @include('components.footer')
@endsection
