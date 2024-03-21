@php
    use Carbon\Carbon;
@endphp
<p>{{ Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y') }}</p>
