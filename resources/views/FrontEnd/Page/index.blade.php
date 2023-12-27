@extends('FrontEnd.app')

@section('title'){{ $page->title }}@endsection

@section('content')
@if ($banners->Count() > 0)
    <div class="home-slider margin-bottom-0">
        @foreach ($banners as $banner)
        <a href="{{ $banner->link }}">
            <div data-background-image="{{ url('/uploads') }}/{{ $banner->image }}" class="item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="home-slider-container">
                                <div class="home-slider-desc">
                                    <div class="home-slider-title mb-4">
                                        <h2 class="mb-1 ft-bold lg-heading">{{ $banner->title }}</h2>
                                        <span class="trending">{{ $banner->description }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
@endif

@if ($homeCategories->Count() > 0)
<section>
    <div class="container-fluid">
        <div class="row no-gutters exlio_gutters">
            @foreach ($homeCategories as $homeCategory)
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="single_cats">
                        <a href="{{ route('products', $homeCategory->slug) }}"
                            class="cards card-overflow card-scale mid_height">
                            <div class="bg-image" style="background:url({{ $homeCategory->image != '' ? url('/uploads') . '/' . $homeCategory->image : asset('FrontEnd/img/bt-1.png') }})no-repeat;" data-overlay="4"></div>
                            <div class="ct_body">
                                <div class="ct_body_caption center text-center">
                                    <h6 class="mb-1 text-light">New Collections</h6>
                                    <h3 class="m-0 ft-bold lh-1 text-light fs-md text-upper">{{ $homeCategory->title }}</h3>
                                </div>
                                <div class="ct_footer center">
                                    <span class="btn btn-white stretched-link fs-md">Shop Now <i class="ti-arrow-circle-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- ======================= Products Lists ======================== -->
<section class="space min pt-0">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h3 class="ft-bold pt-3">New Abaya Collection</h3>
                </div>
            </div>
        </div>

        <div class="row rows-products">
            @foreach ($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                    @include('FrontEnd.Product.widget')
                </div>
            @endforeach
        </div>

    </div>
</section>
<!-- ======================= Products List ======================== -->

@if($testimonials->Count() > 0)
<section class="gray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Testimonials</h2>
                    <h3 class="ft-bold pt-3">Client Reviews</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
                <div class="reviews-slide px-3">
                    @foreach ($testimonials as $testimonial)
                    <div class="single_review">
                        <div class="sng_rev_thumb">
                            <figure><img
                                    src="@if ($testimonial->image == null) {{ asset('FrontEnd/img/team-1.jpg') }} @else {{ url('/uploads') }}/{{ $testimonial->image }} @endif"
                                    class="img-fluid circle" alt="{{ $testimonial->name }}" /></figure>
                        </div>
                        <div class="sng_rev_caption text-center">
                            <div class="rev_desc mb-4">
                                <span class="fs-md">{!! $testimonial->description !!}</span>
                            </div>
                            <div class="rev_author">
                                <h4 class="mb-0">{{ $testimonial->name }}</h4>
                                <span class="fs-sm">{{ $testimonial->position }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if($on_sale_products->Count() > 0)
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h3 class="ft-bold pt-3">On Sale Products</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="slide_items">
                    @foreach($on_sale_products as $on_sale_product)
                        @php $product = $on_sale_product; @endphp
                        <div class="single_itesm">
                            @include('FrontEnd.Product.widget')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
@endif
<!-- ======================= Instagram Start ============================ -->
<!--<section class="p-0">
    <div class="container-fluid p-0">

        <div class="row no-gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Instagram Gallery</h2>
                    <span class="fs-lg ft-bold theme-cl pt-3">@laplain</span>
                    <h3 class="ft-bold lh-1">From Instagram</h3>
                </div>
            </div>
        </div>

        <div class="row no-gutters">

            <div class="col">
                <div class="_insta_wrap">
                    <div class="_insta_thumb">
                        <a href="javascript:void(0);" class="d-block"><img src="{{ asset('FrontEnd/img/i-1.png') }}" class="img-fluid" alt="" /></a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>-->
@endsection