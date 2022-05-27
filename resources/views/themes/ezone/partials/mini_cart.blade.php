<div class="header-cart">
	<a class="icon-cart-furniture" href="{{ url('carts') }}">
		<i class="ti-shopping-cart" style="color:#fff;"></i>
		<span class="shop-count-furniture green">{{ \Cart::getTotalQuantity() }}</span>
	</a>
	@if (!\Cart::isEmpty())
		<ul class="cart-dropdown">
			@foreach (\Cart::getContent() as $item)
				@php
					$product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
					$image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
				@endphp
				<li class="single-product-cart">
					<div class="cart-img">
						<a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
					</div>
					<div class="cart-title">
						<h5><a href="{{ url('product/'. $product->slug) }}">{{ $item->name }}</a></h5>
						<span>Rp.{{ number_format($item->price) }} x {{ $item->quantity }}</span>
					</div>
					<div class="cart-delete">
						<a href="{{ url('carts/remove/'. $item->id)}}" class="delete"><i class="ti-trash"></i></a>
					</div>
				</li>
			@endforeach
			<li class="cart-space">
				<div class="cart-sub">
					<h4>Subtotal</h4>
				</div>
				<div class="cart-price">
					<h4>Rp.{{ number_format(\Cart::getSubTotal()) }}</h4>
				</div>
			</li>
			<li class="cart-btn-wrapper">
				<a class="cart-btn btn-hover" href="{{ url('carts') }}">Lihat </a>
				<a class="cart-btn btn-hover" href="{{ url('orders/checkout') }}">Checkout</a>
			</li>
		</ul>
	@endif
</div>