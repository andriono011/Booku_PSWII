<div class="row">
	@forelse ($products as $product)
		@include('themes.ezone.products.list_box')
	@empty
		Tidak ada produk yang ditemukan!
	@endforelse
</div>