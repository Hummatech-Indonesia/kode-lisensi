@extends('dashboard.layouts.app')
@section('content')
    <div class="col-sm-12">

        @if (session('success'))
            <x-alert-success></x-alert-success>
        @elseif($errors->any())
            <x-validation-errors :errors="$errors"></x-validation-errors>
        @endif

        <div class="title-header option-title">
            <h5>Bantuan</h5>
        </div>

        <div class="col-12 col-sm-3 mb-3">
            <a class="btn btn-primary" href="{{ route('faqs.create') }}">Tambah</a>
        </div>

        @foreach($helps as $help)
            <div class="accordion mb-3" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{$loop->iteration}}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{$loop->iteration}}" aria-expanded="true"
                                aria-controls="collapseOne">
                            {{ $loop->iteration }}. {{  $help->question }}
                        </button>
                    </h2>
                    <form class="d-flex flex-row justify-content-start" method="POST"
                          action="{{ route('faqs.destroy', $help->id) }}">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('faqs.edit', $help->id) }}"
                           class="btn btn-outline-warning m-2">Edit</a>
                        <button onclick="return confirm('Yakin ingin menghapus?')" type="submit"
                                class="m-2 btn btn-outline-danger">Hapus
                        </button>
                    </form>
                    
                    <div id="collapse{{$loop->iteration}}" class="accordion-collapse collapse"
                         aria-labelledby="headingOne"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {{ $help->answer }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
