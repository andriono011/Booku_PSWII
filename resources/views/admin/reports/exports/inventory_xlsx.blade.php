<table>
	<thead>
		<tr>
		<th>Name</th>
		<th>ISBN</th>
		<th>Stock</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($products as $product)
			<tr>    
				<td>{{ $product->name }}</td>
				<td>{{ $product->isbn }}</td>
				<td>{{ $product->stock }}</td>
			</tr>
		@endforeach
	</tbody>
</table>