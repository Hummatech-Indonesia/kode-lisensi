@php use App\Enums\ArticleStatusEnum; @endphp
@if($data->status == ArticleStatusEnum::PUBLISHED->value)
    <span class="badge badge-success">Publish</span>
@else
    <span class="badge badge-danger">Draft</span>
@endif
