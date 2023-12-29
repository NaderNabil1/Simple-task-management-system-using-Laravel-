@extends('Dashboard.app')

@section('title', 'All tasks')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('BackEnd/vendor/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('BackEnd/vendor/DataTables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('BackEnd/vendor/DataTables/Buttons/css/buttons.dataTables.min.css') }}">
@endsection

@section('content')

<div class="content-area p-y-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <h4>All tasks</h4>
                <ol class="breadcrumb no-bg m-b-1">
                    <li class="breadcrumb-item"><a href="{{ Route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Tasks</li>
                </ol>
            </div>
            <div class="col-md-6 col-xs-12"><a href="{{ Route('add-task') }}" class="btn btn-primary w-min-sm m-b-0-25 waves-effect waves-light pull-right">Add Task</a></div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="box box-block bg-white">
            <div class="table-responsive">
            <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Manager</th>
                        <th>User</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if( $tasks->Count() > 0 )
                    @foreach( $tasks as $task )
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->Manager->first_name . ' ' . $task->Manager->last_name }}</td>
                        <td>{{ $task->User->first_name . ' ' . $task->User->last_name }}</td>
                        <td>{{ $task->start_date }}</td>
                        <td>{{ $task->end_date }}</td>
                        <td>{{ $task->status }}</td>
                        <td>
                            <a href="{{ Route('edit-task', $task->id) }}" class="btn btn-success w-min-sm m-b-0-25 waves-effect waves-light">Edit</a>
                            <button data-title="{{ $task->title }}" data-route="{{ Route('delete-task', $task->id) }}" class="btn btn-danger w-min-sm m-b-0-25 waves-effect waves-light run-swal" data-type="cancel">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9"><div class="alert alert-warning">No Tasks available.</div></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>

</div>

@endsection

@section('javascripts')
<script type="text/javascript" src="{{ asset('BackEnd/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('BackEnd/vendor/DataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('BackEnd/vendor/DataTables/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('BackEnd/vendor/DataTables/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('BackEnd/vendor/DataTables/Responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('BackEnd/vendor/DataTables/Buttons/js/dataTables.buttons.min.js') }}"></script>
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
        $('#table-1').dataTable( {
            "pageLength": 50
        });
    });
</script>
@endsection
