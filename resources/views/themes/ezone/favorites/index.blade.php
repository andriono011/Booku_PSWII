@extends('themes.ezone.layout')

@section('content')

	<div class="shop-page-wrapper shop-page-padding ptb-100" style="background-color:#fff;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					@include('themes.ezone.partials.user_menu')
				</div>
				<div class="col-lg-9">
					@include('admin.partials.flash')
					<div class="shop-product-wrapper res-xl">
						<div class="table-content table-responsive">
							<table>
								<thead>
									<tr>
										
										<th>Gambar</th>
										<th>Produk</th>
										<th>Harga</th>
										<th>Hapus</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($favorites as $favorite)
										@php
											$product = $favorite->product;
											$product = isset($product->parent) ?: $product;
											$image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->small) : asset('themes/ezone/assets/img/cart/3.jpg')
										@endphp
										<tr>
											
											<td class="product-thumbnail">
												<a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
											</td>
											<td class="product-name"><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></td>
											<td class="product-price-cart"><span class="amount">Rp. {{ number_format($product->priceLabel()) }}</span></td>
											<td class="product-remove">
												{!! Form::open(['url' => 'favorites/'. $favorite->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                <button type="submit" style="background-color: transparent; color:#333;">X</button>
                                                {!! Form::close() !!}
											</td>
										</tr>
									@empty
										<tr>
											<td colspan="4">Anda tidak memiliki produk Buku favorit</td>
										</tr>
									@endforelse
                                </tbody>
							</table>
							{{ $favorites->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection