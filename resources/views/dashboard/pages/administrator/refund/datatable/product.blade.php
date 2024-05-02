@php
    use App\Helpers\CurrencyHelper;
@endphp

<p>{{ ($data->transaction->detail_transaction->product->name) }}</p>
