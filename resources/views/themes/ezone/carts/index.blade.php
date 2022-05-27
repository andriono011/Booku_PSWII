@extends('themes.ezone.layout')

@section('content')

	<!-- shopping-cart-area start -->
	<div class="cart-main-area pt-95 pb-100" style="background-color:#fff;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1 class="cart-heading">Keranjang Saya</h1>
					{!! Form::open(['url' => 'carts/update']) !!}
						<div class="table-content table-responsive">
							<table>
								<thead>
									<tr>
										<th>Gambar</th>
										<th>Produk</th>
										<th>Harga</th>
										<th>Kuantitas</th>
										<th>Total</th>
										<th>Hapus</th>
									</tr>
								</thead>
								<tbody>
									<!-- <?php $total_amount = 0;?> -->
									@forelse ($items as $item)
										@php
											$product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
											$image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
										@endphp
										<tr>
											<td class="product-thumbnail">
												<a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
											</td>
											<td class="product-name"><a href="{{ url('product/'. $product->slug) }}">{{ $item->name }}</a></td>
											<td class="product-price-cart"><span class="amount">Rp. {{ number_format($item->price) }}</span></td>
											<td class="product-quantity">
												{{-- <input name="" value="{{ $item->quantity }}" type="number" min="1"> --}}
												{!! Form::number('items['. $item->id .'][quantity]', $item->quantity, ['min' => 1, 'required' => true]) !!}
											</td>
											<td class="product-subtotal">Rp.{{ number_format($item->price * $item->quantity)}}</td>
											<td class="product-remove">
												<a href="{{ url('carts/remove/'. $item->id)}}" class="delete"><i class="pe-7s-close"></i></a>
											</td>
										</tr>
									@empty
										<tr>
											<td colspan="6">Keranjang Anda Kosong!</td>
										</tr>
										
									@endforelse
								</tbody>
							</table>
							</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="coupon-all">
									<div class="coupon2">
										<input class="button" name="update_cart" value="Update cart" type="submit">
									</div>
								</div>
							</div>
						</div>
							<div class="row my-5">
								<div class="col-lg-6 col-sm-6">
									<form action="{{url('/carts/apply-coupon')}}" method="post"> {{csrf_field()}}
										</div>
										</form>
									</div>
								</div>
							</div>
							<div class="row my-5">
								<div class="col-lg-6 col-sm-6">
									<form action="{{url('/carts/apply-coupon')}}" method="post"> {{csrf_field()}}
									<div class="coupon-box">
										<div class="input-group input-group-sm">
											<input class="form-control" placeholder="Enter your coupon Code" name="coupon_code" aria-label="Copoun Code" type="text">
											<div class="input-group-append">
												<button class="btn btn-danger btn-sm" type="submit">Apply Coupon</button>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>
							<div class="row">
							<div class="col-md-5 ml-auto">
								<div class="cart-page-total">
							
									<h2>Cart totals</h2>
									<ul>
										<li>Subtotal<span>Rp.{{ number_format(\Cart::getSubTotal()) }}</span></li>
									
										<li>Total<span>Rp.{{ number_format(\Cart::getTotal()) }}</span></li>


									</ul>
									
									<a href="{{ url('orders/checkout') }}">Lanjutkan ke Pembayaran</a>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<!-- shopping-cart-area end -->
@endsection