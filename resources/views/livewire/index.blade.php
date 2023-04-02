@extends('layouts.app')
@section('styles.css')

@endsection
@section('title', 'Posts')
@section('content')
    <div class="container-fluid">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @livewire('items')


    </div>
@endsection
@section('scripts.js')
@endsection
