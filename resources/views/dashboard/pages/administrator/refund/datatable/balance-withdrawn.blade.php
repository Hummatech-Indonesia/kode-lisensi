@php
use App\Helpers\CurrencyHelper;

@endphp
{{CurrencyHelper::rupiahCurrency($data->balance_withdrawn)}}
