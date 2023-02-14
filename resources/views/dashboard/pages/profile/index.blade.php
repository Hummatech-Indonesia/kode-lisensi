@extends('dashboard.layouts.app')
@section('content')
    <div class="col-sm-12">
        <!-- Details Start -->
        <div class="card">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Pengaturan Akun</h5>
                </div>
                <div class="col-sm-4 mb-3">
                    @if (session('success'))
                        <x-alert-success></x-alert-success>
                    @elseif($errors->any())
                        <x-validation-errors :errors="$errors"></x-validation-errors>
                    @endif
                </div>

                <form action="{{ route('user.profile.update', $user->id) }}" class="theme-form theme-form-2 mega-form"
                      method="POST" enctype="multipart/form-data">
                    @method("PATCH")
                    @csrf
                    <div class="row">
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-2 mb-0">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input name="name" value="{{ $user->name }}" autocomplete="off" class="form-control"
                                       type="text"
                                       placeholder="John Doe">
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-2 mb-0">Nomor Telepon</label>
                            <div class="col-sm-10">
                                <input name="phone_number" value="{{ $user->phone_number }}" autocomplete="off"
                                       class="form-control"
                                       type="number"
                                       placeholder="08xx">
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label class="col-sm-2 col-form-label form-label-title">Photo</label>
                            <div class="col-sm-10">
                                <input class="form-control form-choose" type="file" id="formFileMultiple" name="photo">
                            </div>
                        </div>
                        <div class="mb-4 row align-items-center">
                            <label class="col-sm-2 col-form-label form-label-title"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary" type="submit" data-bs-original-title="" title=""><i
                                        class="ri-edit-line ri-1x me-2"></i>Update Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Details End -->
    </div>
@endsection
