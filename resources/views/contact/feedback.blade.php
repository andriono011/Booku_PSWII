@extends('themes.ezone.layout')
@section('content')

<div class="comment-form">
	<h3 class="col-12 text-center">Tinggalkan Balasan</h3>
	<br><br>
		<form action="{{ url('/feedback/proses') }}" method="POST">
            @csrf
			<div class="form-group form-inline">
			<div class="form-group col-lg-3 col-md-3 name" >
				<input type="text" class="form-control" style="background-color:#c4ddfd;" name="nama" id="name" placeholder="Nama Anda" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama Anda'">
				</div>
				<div class="form-group col-lg-6 col-md-6 email">
				<input type="email" class="form-control"  style="background-color:#c4ddfd;" name="email" id="email" placeholder="Email Anda" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Anda'">
            </div>
            </div>
    <div class="form-group">
    <textarea class="form-control mb-10"  style="width=40%; background-color:#c4ddfd;" rows="5" name="review" placeholder="Pesan Anda" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Berikan Balasan'"
    required=""></textarea>
</div>
<button type="submit" style="background-color:#1547A1;"><b>Kirim Pesan</b></button>
</form>

@endsection