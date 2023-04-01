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

        <div class="alert alert-success" style="display: none;"></div>
        <div class="alert alert-danger" style="display: none;"></div>

        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="float-left">
                    <button id="create_modal_btn" class="btn btn-outline-success"><i class="fas fa-plus"></i>
                        {{ __('buttons.create') }}</button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('post.index') }}">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0"
                            type="submit">{{ __('buttons.search') }}</button>
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
                                    <button class="btn btn-outline-primary btn-sm edit_modal_btn"
                                        data-id="{{ $post->id }}"><i class="fas fa-edit"></i></button>
                                    {{-- <button class="btn btn-outline-danger btn-sm delete_modal_btn"
                                        data-id="{{ $post->id }}"><i class="fas fa-trash"></i></button> --}}
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
@section('modal')
    <!-- Create Post Modal -->
    <div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="create_modal_title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal_title">{{ __('titles.create_post') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="create_save_form" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">{{ __('titles.title') }}</label>
                            <input type="text" class="form-control" placeholder="Enter Title" name="title"
                                id="title" required>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="active" name="active" value="1">
                            <label class="form-check-label" for="active">{{ __('titles.status') }}</label>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('titles.image') }}</label>
                            <input type="file" class="form-control-file" id="image" name="image" required
                                onchange="previewImage();">
                        </div>
                        <div class="form-group">
                            <img id="preview" src="#" alt="Image Preview" class="img-thumbnail rounded-circle"
                                style="width: 100px; height: 100px; display: none;">
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('titles.description') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('buttons.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('buttons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Create Post Modal -->

    <!-- Edit Post Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal_title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_modal_title">{{ __('titles.edit_post') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit_save_form" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">{{ __('titles.title') }}</label>
                            <input type="text" class="form-control" placeholder="Enter Title" name="title"
                                value="" id="title" required>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="active" name="active">
                            <label class="form-check-label" for="active">{{ __('titles.status') }}</label>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('titles.image') }}</label>
                            <input type="file" class="form-control-file" id="image" name="image"
                                value="" onchange="previewImage();">
                        </div>
                        <div class="form-group">
                            <img id="preview" src="" alt="Image Preview" class="img-thumbnail rounded-circle"
                                style="width: 100px; height: 100px;">
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('titles.description') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger mr-auto" id="delete_btn"
                            data-id="">{{ __('buttons.delete') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('buttons.close') }}</button>
                        <button type="button" class="btn btn-success" id="update_btn"
                            data-id="">{{ __('buttons.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Post Modal -->


@endsection

@section('scripts.js')

    <script>
        $(document).ready(function() {
            // Create Modal
            $('#create_modal_btn').click(function() {
                $('#create_modal').modal('show');
            });

            //create post ajax request
            $('#create_save_form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('post.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#create_modal').modal('hide');
                        $('.alert-success').html(data.success).show();
                        //after 3 sec location.reload();
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function(data) {
                        console.log(data);
                        $('.alert-danger').html("Error: " + data.statusText).show();
                    }
                });


            });

            //open edit modal and get data from database using ajax request and show in modal form
            $('.edit_modal_btn').click(function() {
                var id = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    url: "/post/edit/" + id,
                    success: function(data) {
                        var post = data.post[0];
                        $('#edit_modal').modal('show');
                        $('#edit_save_form').find('#title').val(post.title);
                        $('#edit_save_form').find('#description').val(post.description);
                        //check if $request->has('active') ?'Y' : 'N'; is true or false
                        if (post.active == 'Y') {
                            $('#edit_save_form').find('#active').prop('checked', true);
                        } else {
                            $('#edit_save_form').find('#active').prop('checked', false);
                        }
                        $('#edit_save_form').find('#preview').attr('src', '/post_images/' + post
                            .image);
                        $('#edit_save_form').attr('action', '/post/' + post.id);
                        $('#update_btn').attr('data-id', post.id);
                        $('#delete_btn').attr('data-id', post.id);

                    },
                    error: function(data) {
                        console.log(data);
                        $('.alert-danger').html("Error: " + data.statusText).show();
                    }


                });
            });

            /* Updating the data in the database. */
            $('#update_btn').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var formData = new FormData($('#edit_save_form')[0]);
                $.ajax({
                    type: 'POST',
                    url: '/post/update/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#edit_modal').modal('hide');
                        $('.alert-success').html(data.success).show();
                        //after 3 sec location.reload();
                        setTimeout(function() {
                            location.reload();
                        }, 2000);


                    },
                    error: function(data) {
                        console.log(data);
                        $('.alert-danger').html("Error: " + xhr.statusText).show();
                    }
                });
            });

            //delete post ajax request
            $('#delete_btn').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type: 'delete',
                    url: '/post/delete/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#edit_modal').modal('hide');
                        location.reload();
                        $('.alert-success').html(data.success).show();
                    },
                    error: function(data) {
                        console.log(data);
                        $('.alert-danger').html("Error: " + data.statusText).show();
                    }
                });
            });

        });

        // Image Preview Function
        function previewImage() {
            var preview = document.getElementById('preview');
            var file = document.getElementById('image').files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
