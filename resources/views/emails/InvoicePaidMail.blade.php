@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\ProductTypeEnum;
    use App\Helpers\CurrencyHelper;
    use Carbon\Carbon;
@endphp

<div
    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">

    <div class="container" style="margin: 2rem">

        <div style="text-align: center">
            <img width="20%" src="{{ config('app.url') . 'storage/' . $site->logo }}" alt="Logo">
        </div>

        <h2 style="text-align: center; margin-bottom:1.5rem">Terimakasih Telah Membeli Produk Kami</h2>
        @if (ProductTypeEnum::CREDENTIAL->value === $data['product_type'])
            <h4>Username: </h4>

            <p>{{ $data['licenses']['username'] }}</p>
            <h4>Password: </h4>

            <p>{{ $data['licenses']['password'] }}</p>
        @else
            @if ($data['varian_product'])
                <h4>License Key {{ $data['pack_name'] }} ({{ $data['varian_product'] }})</h4>
            @else
                <h4>License Key {{ $data['pack_name'] }}</h4>
            @endif

            <p>{{ $data['licenses']['serial_key'] }}</p>
        @endif


        @if ($data['varian_product'])
            <h4 class="mt-3" style="text-align: center">Panduan Aktifitasi {{ $data['pack_name'] }}
                ({{ $data['varian_product'] }})</h4>
        @else
            <h4 class="mt-3" style="text-align: center">Panduan Aktifitasi {{ $data['pack_name'] }}</h4>
        @endif


        @if ($data['product']->productEmail)
            {!! $data['product']->productEmail->manual_book !!}
        @else
            {!! $data['product']->installation !!}
        @endif

        <h4 class="mt-3" style="text-align: center">PERHATIAN:</h4>

        @if ($data['product']->productEmail)
            {!! $data['product']->productEmail->note !!}
        @else
            {!! $data['product']->description !!}
        @endif

        <p>Terima kasih sudah belanja di <a href="https://kodelisensi.com/">kodelisensi.com</a></p>



    </div>
</div>
