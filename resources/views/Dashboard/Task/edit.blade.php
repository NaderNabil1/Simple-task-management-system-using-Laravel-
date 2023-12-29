@extends('Dashboard.app')
@section('title', 'Edit task')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('BackEnd/vendor/dropify/dist/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('BackEnd/vendor/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('BackEnd/vendor/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<div class="content-area p-y-1">
    <div class="container-fluid">
        <h4>Edit task</h4>
        <ol class="breadcrumb no-bg m-b-1">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ Route('be-tasks') }}">Tasks</a></li>
            <li class="breadcrumb-item active">Edit task</li>
        </ol>
    </div>

    <div class="container-fluid">
        <div class="box box-block bg-white">
            <div class="row">
                <div class="col-md-6 col-xs-12"><h5 class="m-b-1">Edit task</h5></div>
            </div>

            <div class="box box-block bg-white">
                <form method="post" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{ $task->title }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="4"  class="form-control" placeholder="Enter description">{{ $task->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="user">User</label>
                                <select name="user" class="form-control">
                                    <option value="">Please select User</option>
                                    @foreach ($users as $user)
                                    <option {{ $task->user ==  $user->id ? 'selected' : ''}} value="{{ $user->id }}">{{ $task->User->first_name . ' ' . $task->User->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control"  value="{{ $task->start_date }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="end_date">End date</label>
                                <input type="date" name="end_date" class="form-control"  value="{{ $task->end_date }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" name="file" class="dropify" @if($task->file != '') data-default-file="{{ url('/uploads') . '/' . $task->file }}" @endif>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="status" class="custom-control-input" {{ $task->status == 'Completed' ? 'checked' : '' }}>
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Completed</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section('javascripts')
<script type="text/javascript" src="{{ asset('BackEnd/js/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('BackEnd/js/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('BackEnd/vendor/dropify/dist/js/dropify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('BackEnd/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('BackEnd/vendor/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify();
        $('#form').validate({
            rules: {
                title: { required: true }
            },
            messages: {
                title: { required: "Title is required" }
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.run-swal').on('click', function () {
            var type = $(this).data('type');
            var $url = $(this).data('route');
            var $title = $(this).data('title');
            if (type === 'cancel') {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert " + $title + " Again!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonText: 'Yes, delete it!',
                    confirmButtonClass: 'btn btn-danger btn-lg m-r-1',
                    cancelButtonClass: 'btn btn-secondary btn-lg',
                    buttonsStyling: false
                }).then(function (isConfirm) {
                    if (isConfirm === true) {
                        window.location = $url;
                    }
                })
            }
        });
    });
</script>
@endsection
