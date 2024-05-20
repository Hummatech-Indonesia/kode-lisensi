@if ($data->order_via_whatsapp == 1)
    <p>Manual</p>
@elseif($data->order_via_whatsapp == 0)
    <p>E-Commerce</p>
@endif
