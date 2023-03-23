@extends('layouts.app')
@section('styles.css')

@endsection
@section('title', 'Posts')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('/home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('post.index') }}">{{ __('titles.post') }}</a></li>
                </ol>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="float-left">
                    <a href="#" class="btn btn-outline-success"><i class="fas fa-plus"></i>
                        {{ __('titles.create') }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('post.index') }}">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('titles.id') }}</th>
                            <th scope="col">{{ __('titles.title') }}</th>
                            <th scope="col">{{ __('titles.active') }}</th>
                            <th scope="col">{{ __('titles.image') }}</th>
                            <th scope="col">{{ __('titles.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->active }}</td>
                                <td><img src="/post_images/{{ $post->image }}" alt="Image Not Exists!!!" width="20px"
                                        height="20px"></td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 float-right">
                {{ $posts->links() }}
            </div>
        </div>

    </div>
@endsection

@section('scripts.js')

@endsection
