@if ($data->order_via_whatsapp == 1)
    <p>Rekening</p>
@elseif($data->order_via_whatsapp == 0)
    <p>Tripay</p>
@endif
