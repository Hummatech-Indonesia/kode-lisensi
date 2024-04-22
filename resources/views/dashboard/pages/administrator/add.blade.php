@extends('dashboard.layouts.app')
@section('content')
    THIS IS ADMINISTRATOR ORDER PAGE
    <div class="card">
        <div class="col-xxl-12 col-lg-12 col-sm-12">
            <div class="mb-md-4 mb-3 custom-form">
                <label for="exampleFormControlInput" class="form-label">Nama
                    Lengkap</label>
                <div class="custom-input">
                    <input autofocus value="{{ auth()->user()->name }}" type="text" name="name"
                        class="form-control @error('name') is-invalid @enderror" autocomplete="off" placeholder="John Doe">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-xxl-12 col-lg-12 col-sm-12">
            <div class="mb-md-4 mb-3 custom-form">
                <label for="exampleFormControlInput2" class="form-label">Email</label>
                <div class="custom-input">
                    <input autocomplete="off" type="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ auth()->user()->email }}" name="email" placeholder="johndoe@gmail.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-xxl-12 col-lg-12 col-sm-12">
            <div class="mb-md-4 mb-3 custom-form">
                <label for="exampleFormControlInput3" class="form-label">Nomor telepon</label>
                <div class="custom-input">
                    <input autocomplete="off" value="{{ old('phone_number', auth()->user()->phone_number) }}"
                        name="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror"
                        id="exampleFormControlInput3" placeholder="0812648321">
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-xxl-12 col-lg-12 col-sm-12">
            <div class="mb-md-4 mb-3 custom-form">
                <label for="exampleFormControlInput4" class="form-label">Role Pengguna</label>
                <div class="custom-input">
                    <div class="d-flex gap-2">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="customer" value="customer">
                            <label class="form-check-label" for="customer">
                                Customer
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="reseller" value="reseller">
                            <label class="form-check-label" for="reseller">
                                Reseller
                            </label>
                        </div>
                    </div>
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-xxl-12 col-lg-12 col-sm-12">
            <div class="mb-md-4 mb-3 custom-form">
                <label for="exampleFormControlInput5" class="form-label">Produk</label>
                <div class="custom-input">
                    <select name="product" id="productSelection" class="form-select">
                        <option value="">Pilih Produk</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-variants="{{ json_encode($product->varianProducts) }}">
                                {{ $product->name }}</option>
                        @endforeach
                    </select>
                    <select name="sell_price_varian" id="sell_price_varian" class="form-select mt-3" style="display: none;">
                        <option value="">Pilih Varian</option>
                    </select>

                    @error('product')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $('input[name="role"]').change(function() {
            role = $('input[name="role"]:checked').val();
        });
        $('select[name="product"]').change(function() {
            var product = $(this).val();
            var variants = $(this).find('option:selected').data('variants');

            const convertRupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }
            // Jika produk memiliki varian, tampilkan opsi varian

            if (variants.length > 0) {
                $('#sell_price_varian').empty().show();
                $.each(variants, function(index, variant) {
                    $('#sell_price_varian').append('<option value="' + variant.id + '">' + variant.name +
                        " - " + convertRupiah(variant.sell_price) +
                        '</option>');
                });
            } else {
                $('#sell_price_varian').empty().hide();
            }

            console.log(product);
        });
    </script>
@endsection
