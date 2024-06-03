@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\ProductTypeEnum;
    use App\Helpers\CurrencyHelper;
    use Carbon\Carbon;
@endphp
<style>
    .align-between {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
<div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
    <div style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
        <div style="background-color: #f8f9fa; padding: 10px;">
            <img src="https://kodelisensi.com/storage/site_setting//profil-kodelisensi-2024-04-05-10-03-49.png" alt="Logo" style="width: 100%; height: auto;">
        </div>
        <div style="padding: 20px;">
            <div class="align-between">
                <div>
                    <h2 style="font-weight: bold; color: #007bff;">Terima Kasih</h2>
                </div>
                <div>
                    <span>No. Invoice: <strong>KLHM0540</strong></span>
                </div>
            </div>
            
            <p style="font-weight: bold;">Pembelian Anda telah berhasil. Di bawah ini adalah detail pembelian Anda:</p>

            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;" colspan="2">
                        <p style="font-weight: bold;">Nama Produk</p>
                        @if ($data['varian_product'])
                            <h4>{{ $data['pack_name'] }} ({{ $data['varian_product'] }})</h4>
                        @else
                            <h4>{{ $data['pack_name'] }}</h4>
                        @endif
                    </td>
                    <td style="border: 1px solid #ddd; padding: 10px;">
                        <p style="font-weight: bold;">Harga</p>
                        <p style="font-weight: bold;">{{CurrencyHelper::rupiahCurrency($data['pack_price'])}}</p>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;" colspan="3">
                        @if ($data['product_type'] === ProductTypeEnum::CREDENTIAL->value)
                            <h4>Username:</h4>
                            <p>{{ $data['licenses']['username'] }}</p>
                            <h4>Password:</h4>
                            <p>{{ $data['licenses']['password'] }}</p>
                        @elseif ($data['product_type'] === ProductTypeEnum::DESCRIPTION->value)
                            @if ($data['varian_product'])
                                <h4>Deskripsi {{ $data['pack_name'] }} ({{ $data['varian_product'] }})</h4>
                            @else
                                <h4>Deskripsi {{ $data['pack_name'] }}</h4>
                            @endif
                            <p>{{ $data['licenses']['description'] }}</p>
                        @else
                            @if ($data['varian_product'])
                                <h4>License Key {{ $data['pack_name'] }} ({{ $data['varian_product'] }})</h4>
                            @else
                                <h4>License Key {{ $data['pack_name'] }}</h4>
                            @endif
                            <p>{{ $data['licenses']['serial_key'] }}</p>
                        @endif
                    </td>
                </tr>
            </table>
            
            <div style="background-color: #fff; border: 1px solid #dc3545; border-radius: 8px; padding: 20px; margin-top: 20px;">
                <p style="font-weight: bold; color: #dc3545;">PERHATIAN !!</p>
                @if ($data['product']->productEmail)
                    {!! $data['product']->productEmail->note !!}
                @else
                    {!! $data['product']->description !!}
                @endif
            </div>
        </div>
    </div>
</div>
