@extends('BackEnd.app')
@section('title', 'Edit product')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('BackEnd/vendor/dropify/dist/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('BackEnd/vendor/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('BackEnd/vendor/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<div class="content-area p-y-1">
    <div class="container-fluid">
        <h4>Edit product</h4>
        <ol class="breadcrumb no-bg m-b-1">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ Route('be-products') }}">Products</a></li>
            <li class="breadcrumb-item active">Edit product</li>
        </ol>
    </div>

    <div class="container-fluid">
        <div class="box box-block bg-white">
            <div class="row">
                <div class="col-md-6 col-xs-12"><h5 class="m-b-1">Edit product</h5></div>
            </div>

            <div class="box box-block bg-white">
                <form method="post" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{ $product->title }}">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="meta_title">Meta title</label>
                                <input type="text" name="meta_title" class="form-control" id="title_ar" placeholder="Enter meta title" value="{{ $product->meta_title }}">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" name="code" class="form-control" id="code" placeholder="Enter product code" value="{{ $product->code }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Please select category</option>
                                    @foreach ($categories as $category)
                                    <option {{ $product->category ==  $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="color">Color</label>
                                <select class="form-control palette" name="color">
                                    <option value="">Please select color</option>
                                    @foreach ($colors as $color)
                                    <option {{ $product->color ==  $color->id ? 'selected' : ''}} value="{{ $color->id }}">{{ $color->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control" id="price" placeholder="Enter product price" value="{{ $product->price }}">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="sale_price">Sale price</label>
                                <input type="number" name="sale_price" class="form-control" id="price" placeholder="Enter product sale price" value="{{ $product->sale_price }}">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="sale_end_date">Sale end date</label>
                                <input type="date" name="sale_end_date" class="form-control" id="sale_end_date" value="{{ $product->sale_end_date }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="4" id="description" class="form-control" placeholder="Enter description">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="meta_description">Meta description</label>
                                <textarea name="meta_description" rows="4" id="meta_description" class="form-control" placeholder="Enter meta description">{{ $product->meta_description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="video">Video</label>
                                <input type="text" name="video" class="form-control" id="video" placeholder="Enter product video URL" value="{{ $product->video }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="dropify" id="image" data-max-file-size="2M" @if($product->image != '') data-default-file="{{ url('/uploads') . '/' . $product->image }}" @endif>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="image_two">Image Hover</label>
                                <input type="file" name="image_two" class="dropify" id="image_two" data-max-file-size="2M" @if($product->image_two != '') data-default-file="{{ url('/uploads') . '/' . $product->image_two }}" @endif>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="gallery">Gallery</label>
                                <input type="file" name="gallery[]" multiple class="dropify" id="image" data-max-file-size="2M">
                                @if($gallery->Count() > 0)
                                <div class="row">
                                    @foreach($gallery as $item)
                                    <div class="col-md-3 col-xs-6">
                                        <img src="{{ url('uploads') }}/{{ $item->path }}" alt="{{ $product->title }}" class="img-thumbnail">
                                        <a href="#!" data-title="this image" data-route="{{ Route('delete-file', $item->id) }}" class="btn btn-danger w-min-sm m-b-0-25 waves-effect waves-light run-swal" data-type="cancel">Delete</a>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 col-xs-12"><h4>Sizes & Stocks</h4><div>
                        <hr/>
                    </div>
                    <div class="row">
                        @foreach($sizes as $key => $size)
                        <div class="col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="size">{{ $size->title }}</label>
                                <input type='number' min='0' name='size-{{ $key }}' class="form-control" value='{{ $size->stock }}'>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="status" class="custom-control-input" {{ $product->status == 'Published' ? 'checked' : '' }}>
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Publish</span>
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
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify();
        $('[data-plugin="select2"]').select2($(this).attr('data-options'));
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
<script>
    $("body").on('change', "#category", (function () {
        var $id = $(this).val();
        var $this = $(this);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: "{{ Route('get-subcategories') }}",
            data: {
                id: $id
            },
            success: function (result) {
            if (result && result?.status === "success") {
                if(result?.categories != null){
                    $('.subcategory').empty();
                    for (const category of result?.categories) {
                        var $name = category['title'];
                        var $id = category['id'];
                        $('.subcategory').append('<option value="' + $id + '">' + $name + '</option>');
                    }
                    $('.subcategory').prop("disabled", false);
                    $('.palette').empty();
                    for (const palette of result?.palettes) {
                        var $name = palette['title'];
                        var $id = palette['id'];
                        $('.palette').append('<option value="' + $id + '">' + $name + '</option>');
                    }
                    $('.palette').prop("disabled", false);
                }
            }},
            error: function (result) {
                console.log("error", result);
            },
        });
    }));
    $("body").on('change', ".category", (function () {
        var $id = $(this).val();
        var $this = $(this);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: "{{ Route('get-palettes') }}",
            data: {
                id: $id
            },
            success: function (result) {
            if (result && result?.status === "success") {
                if(result?.data == null){

                } else {
                    $this.parent().parent().parent().find('.palette').empty();
                    for (const store of result?.data) {
                        var $name = palette['title'];
                        var $id = palette['palette']['id'];
                        $this.parent().parent().parent().find('.palette').append('<option value="' + $id + '">' + $name + ' - ' + $stock + ' Items </option>');
                    }
                    $this.parent().parent().parent().find('.palette').prop("disabled", false);
                }
            }},
            error: function (result) {
                console.log("error", result);
            },
        });
    }));
    </script>
@endsection
