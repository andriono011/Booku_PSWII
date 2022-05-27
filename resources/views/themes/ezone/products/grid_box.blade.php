<div class="col-md-6 col-xl-4">
	<div class="product-wrapper mb-30">
		<div class="product-img">
			<a href="{{ url('product/'. $product->slug) }}">
				@if ($product->productImages->first())
					<img src="{{ asset('storage/'.$product->productImages->first()->medium) }}" alt="{{ $product->name }}">
				@else
					<img src="{{ asset('themes/ezone/assets/img/product/fashion-colorful/1.jpg') }}" alt="{{ $product->name }}">
				@endif
			</a>
		
			<div class="product-action">
				<a class="animate-left add-to-fav" title="Favorite"  product-slug="{{ $product->slug }}" href="">
					<i class="pe-7s-like"></i>
				</a>
				<a class="animate-top add-to-card" title="Add To Cart" href="" product-id="{{ $product->id }}" product-type="{{ $product->type }}" product-slug="{{ $product->slug }}">
					<i class="pe-7s-cart" style="color:#fff;"></i>
				</a>
				<a class="animate-right quick-view" title="Quick View" product-slug="{{ $product->slug }}" href="">
					<i class="pe-7s-look"></i>
				</a>
			</div>
		</div>
		<div class="product-content">
			<h4><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></h4>
			<span>Rp. {{ number_format($product->priceLabel()) }},00</span>
		</div>
	</div>
</div>