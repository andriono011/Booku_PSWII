@component('mail::message')

#Yeay, pesananmu sudah terkirim!
Kami mengirimkan pesanan Anda di<strong>{{\General::datetimeFormat($order->shipment->shipped_at)}}</strong> dan ini nomor pelacakan Anda:<strong>{{ $order->shipment->track_number }}</strong>
<br>
<br/>
Detail pesanan Anda ditunjukkan di bawah ini untuk referensi Anda:
## Order #{{ $order->code }} ({{\General::datetimeFormat($order->order_date)}})

@component('mail::table')
| Product       | Quantity      | Price  |
| ------------- |:-------------:| --------:|
@foreach ($order->orderItems as $item)
| {{ $item->name }}      |  {{ $item->qty }}      | {{ \General::priceFormat($item->sub_total) }}      |
@endforeach
| &nbsp;         | <strong>Sub total</strong> | {{ \General::priceFormat($order->base_total_price) }} |
| &nbsp;         | Tax (10%)     | {{ \General::priceFormat($order->tax_amount) }} |
| &nbsp;         | Shipping cost | {{ \General::priceFormat($order->shipping_cost) }} |
| &nbsp;         | <strong>Total</strong> | <strong>{{ \General::priceFormat($order->grand_total) }}</strong>|
@endcomponent

## Detail Pemesanan Buku:
<strong>{{ $order->customer_first_name }} {{ $order->customer_last_name }}</strong>
<br> {{ $order->customer_address1 }}
<br> {{ $order->customer_address2 }}
<br> Email: {{ $order->customer_email }}
<br> No.Telepon: {{ $order->customer_phone }}
<br> Kodepos: {{ $order->customer_postcode }}

## Shipment Address (shipped by: {{ $order->shipping_service_name }}):
<strong>{{ $order->shipment->first_name }} {{ $order->shipment->last_name }}</strong>
<br> {{ $order->shipment->address1 }}
<br> {{ $order->shipment->address2 }}
<br> Email: {{ $order->shipment->email }}
<br> No.Telepon: {{ $order->shipment->phone }}
<br> KodePos: {{ $order->shipment->postcode }}

@component('mail::button', ['url' => url('orders/received/'. $order->id)])
Show order detail
@endcomponent

Terimakasih Telah Berbelanja di BookuShop,<br>
{{ config('app.name') }}
@endcomponent
