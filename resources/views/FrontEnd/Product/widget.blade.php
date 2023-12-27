<div class="product_grid card b-0">
    @if($product->created_at > now()->subWeek())
    <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">New</div>
    @endif
    @if($product->sale_end_date > now())
    <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">-{{ number_format(100 - ($product->sale_price / $product->price * 100)) }}%</div>
    @endif
    <div class="card-body p-0">
        <div class="shop_thumb position-relative">
            <a href="{{ Route('product-details', ['slug' => $product->Category->slug, 'prodSlug' => $product->slug]) }}">
                @if($product->image != '')
                <div class="card-img-top d-block overflow-hidden @if($product->image_two != '') ovr-hide @endif"><img class="card-img-top" src="{{ url('/uploads') }}/{{ $product->image }}" alt="{{ $product->title }}"></div>
                @else
                <div class="card-img-top d-block overflow-hidden"><img class="card-img-top" src="{{ asset('FrontEnd/img/product/13.jpg') }}" alt="{{ $product->title }}"></div>
                @endif
                @if($product->image_two != '')
                <div class="card-img-top d-block overflow-hidden ovr-show"><img class="card-img-top" src="{{ url('/uploads') }}/{{ $product->image_two }}" alt="{{ $product->title }}"></div>
                @endif
            </a>
            <div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                <div class="edlio"><a href="{{ Route('product-details', ['slug' => $product->Category->slug, 'prodSlug' => $product->slug]) }}" class="text-white fs-sm ft-medium"><i class="fas fa-eye mr-1"></i>View & Buy</a></div>
            </div>
        </div>
    </div>
    <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
        <div class="text-left">
            <div class="text-left">
                <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                    @for( $i = 0; $i < $product->rate; $i++ )
                    <i class="fas fa-star filled"></i>
                    @endfor
                    @for( $i = 0; $i < 5 - $product->rate; $i++ )
                    <i class="fas fa-star"></i>
                    @endfor
                </div>
                <h5 class="fs-md mb-0 lh-1 mb-1"><a href="{{ Route('product-details', ['slug' => $product->Category->slug, 'prodSlug' => $product->slug]) }}">{{ $product->title }}</a></h5>
                <div class="elis_rty">
                    @if ($product->sale_price != NULL && $product->sale_end_date > now())
                    <span class="text-muted ft-medium line-through mr-2">{{ number_format($product->price) }} AED</span>
                    <span class="ft-bold theme-cl fs-md">{{ number_format($product->sale_price) }} AED</span>
                    @else
                    <span class="ft-bold fs-md text-dark">{{ number_format($product->price) }} AED</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>