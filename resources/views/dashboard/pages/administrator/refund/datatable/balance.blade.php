@php
    use App\Helpers\CurrencyHelper;
@endphp

<p>{{ currencyHelper::rupiahCurrency($data->transaction->paid_amount) }}</p>
