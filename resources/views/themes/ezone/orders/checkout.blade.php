@extends('themes.ezone.layout')

@section('content')
	<br>
	<!-- checkout-area start -->
	<div class="checkout-area ptb-100">
		<div class="container">
			@include('admin.partials.flash', ['$errors' => $errors])

			{!! Form::model($user, ['url' => 'orders/checkout']) !!}
			<div class="row">
				<div class="col-lg-6 col-md-12 col-12">
					<div class="checkbox-form">						
						<h3>Alamat Tujuan</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Nama Depan <span class="required">*</span></label>										
									{!! Form::text('first_name', null, ['required' => true]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Nama Belakang <span class="required">*</span></label>										
									{!! Form::text('last_name', null, ['required' => true]) !!}
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Nama Perusahaan</label>
									{!! Form::text('company') !!}
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Alamat <span class="required">*</span></label>
									{!! Form::text('address1', null, ['required' => true, 'placeholder' => 'Nomor rumah dan nomor jalan']) !!}
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									{!! Form::text('address2', null, ['placeholder' => 'Apartemen, suite, unit, dll. (opsional)']) !!}
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Provinsi<span class="required">*</span></label>
									{!! Form::select('province_id', $provinces, Auth::user()->province_id, ['id' => 'province-id', 'placeholder' => '- Please Select - ', 'required' => true]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Kota<span class="required">*</span></label>
									{!! Form::select('city_id', $cities, null, ['id' => 'city-id', 'placeholder' => '- Please Select -', 'required' => true])!!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>KodePos/ Zip <span class="required">*</span></label>										
									{!! Form::number('postcode', null, ['required' => true, 'placeholder' => 'Postcode']) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>No.Telepon  <span class="required">*</span></label>										
									{!! Form::text('phone', null, ['required' => true, 'placeholder' => 'Phone']) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Alamat Email</label>										
									{!! Form::text('email', null, ['placeholder' => 'Email', 'readonly' => true]) !!}
								</div>
							</div>							
						</div>
						<div class="different-address">
							<div class="ship-different-title">
								<h3>
									<label>Kirim ke Alamat Lain?</label>
									<input id="ship-box" type="checkbox" name="ship_to"/>
								</h3>
							</div>
							<div id="ship-box-info">
								<div class="row">
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Nama Depan <span class="required">*</span></label>										
											{!! Form::text('shipping_first_name') !!}
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Nama Belakang <span class="required">*</span></label>										
											{!! Form::text('shipping_last_name') !!}
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Nama Perusahaan</label>
											{!! Form::text('shipping_company') !!}
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Alamat<span class="required">*</span></label>
											{!! Form::text('shipping_address1', null, ['placeholder' => 'Nomor rumah dan nomor jalan']) !!}
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											{!! Form::text('shipping_address2', null, ['placeholder' => 'Apartemen, suite, unit, dll. (opsional)']) !!}
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Provinsi<span class="required">*</span></label>
											{!! Form::select('shipping_province_id', $provinces, null, ['id' => 'shipping-province', 'placeholder' => '- Please Select - ']) !!}
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Kota<span class="required">*</span></label>
											{!! Form::select('shipping_city_id', [], null, ['id' => 'shipping-city','placeholder' => '- Please Select -'])!!}
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Postcode / Zip <span class="required">*</span></label>										
											{!! Form::number('shipping_postcode', null, ['placeholder' => 'Postcode']) !!}
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>No.Telepon  <span class="required">*</span></label>										
											{!! Form::text('shipping_phone', null, ['placeholder' => 'Phone']) !!}
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Email </label>										
											{!! Form::text('shipping_email', null, ['placeholder' => 'Email']) !!}
										</div>
									</div>	
								</div>					
							</div>
							<div class="order-notes">
								<div class="checkout-form-list mrg-nn">
									<label>Catatan Pembelian</label>
									{!! Form::textarea('note', null, ['cols' => 30, 'rows' => 10,'placeholder' => 'Catatan tentang pesanan Anda...']) !!}
								</div>									
							</div>
						</div>													
					</div>
				</div>	
				<div class="col-lg-6 col-md-12 col-12">
					<div class="your-order" style="background-color:#b2c4fa;">
						<h3>Orderan Anda</h3>
						<div class="your-order-table table-responsive">
							<table>
								<thead>
									<tr>
										<th class="product-name">Produk</th>
										<th class="product-total">Total</th>
									</tr>							
								</thead>
								<tbody>
									@forelse ($items as $item)
										@php
											$product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
											$image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
										@endphp
										<tr class="cart_item">
											<td class="product-name">
												{{ $item->name }}	<strong class="product-quantity"> × {{ $item->quantity }}</strong>
											</td>
											<td class="product-total">
												<span class="amount">Rp.{{ number_format(\Cart::get($item->id)->getPriceSum()) }}.00</span>
											</td>
										</tr>
									@empty
										<tr>
											<td colspan="2">Keranjang Kosong!</td>
										</tr>
									@endforelse
								</tbody>
								
							
								<tfoot>
									
									<tr class="cart-subtotal">
										<th>Subtotal</th>
										<td><span class="amount">Rp.{{ number_format(\Cart::getSubTotal()) }}.00</span></td>
									</tr>
									<tr class="cart-subtotal">
										<th>Tax</th>
										<td><span class="amount">Rp.{{ number_format(\Cart::getCondition('TAX 10%')->getCalculatedValue(\Cart::getSubTotal())) }}.00</span></td>
									</tr>
									<tr class="cart-subtotal">
										<th>Shipping Cost ({{ $totalWeight }} kg)</th>
										<td><select id="shipping-cost-option" required name="shipping_service"></select></td>
									</tr>
									<tr class="order-total">
										<th>Total Orderan</th>
										<td><strong><span class="total-amount">Rp.{{ number_format(\Cart::getTotal()) }}.00</span></strong>
										</td>
									</tr>								
								</tfoot>
								
								</table>
	
						<div class="payment-method">
							<div class="payment-accordion">
								<div class="panel-group" id="faq">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq" href="#payment-1">Transfer Bank Langsung</a></h5>
										</div>
										<div id="payment-1" class="panel-collapse collapse show">
											<div class="panel-body">
												<p>Lakukan pembayaran langsung ke rekening bank kami. Silakan gunakan ID Pesanan Anda sebagai referensi pembayaran. Pesanan Anda tidak akan dikirim sampai dana dicairkan di rekening kami.</p>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-2">Cek Pembayaran</a></h5>
										</div>
										<div id="payment-2" class="panel-collapse collapse">
											<div class="panel-body">
												<p>Lakukan pembayaran langsung ke rekening bank kami. Silakan gunakan ID Pesanan Anda sebagai referensi pembayaran. Pesanan Anda tidak akan dikirim sampai dana dicairkan di rekening kami.</p>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-3">PayPal</a></h5>
										</div>
										<div id="payment-3" class="panel-collapse collapse">
											<div class="panel-body">
												<p>Lakukan pembayaran langsung ke rekening bank kami. Silakan gunakan ID Pesanan Anda sebagai referensi pembayaran. Pesanan Anda tidak akan dikirim sampai dana dicairkan di rekening kami.</p>
											</div>
										</div>
									</div>
								</div>
								<div class="order-button-payment">
									<input type="submit" value="Lakukan Pembayaran" />
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
							
			{!! Form::close() !!}
		</div>
	</div>
	<!-- checkout-area end -->	
@endsection