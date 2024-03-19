@extends('dashboard.layouts.app')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-sm-12 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Tambah Pengguna</h5>
                        </div>
                        <div class="col-sm-6 my-3">
                            <div class="alert alert-warning">
                                Catatan: <br>
                                <ul>
                                    <li>Ketika anda mengosongi password, default password adalah "password"</li>
                                </ul>
                            </div>
                        </div>
                        @if (session('success'))
                            <x-alert-success></x-alert-success>
                        @elseif($errors->any())
                            <x-validation-errors :errors="$errors"></x-validation-errors>
                        @endif

                        <form enctype="multipart/form-data" action="{{ route('users.store') }}"
                            class="theme-form theme-form-2 mega-form" method="POST">
                            @csrf
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Nama Pengguna <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="name" autocomplete="off" class="form-control" type="text"
                                        placeholder="Nama Pengguna">
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Email Pengguna <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="email" autocomplete="off" class="form-control" type="text"
                                        placeholder="Email Pengguna">
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Role <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="role" class="form-control" id="">
                                        <option value="admin">Admin</option>
                                        <option value="author">Author</option>
                                        <option value="reseller">Reseller</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Password </label>
                                <div class="col-sm-9">
                                    <input name="password" autocomplete="off" class="form-control" type="password"
                                        placeholder="Password">
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <div class="col-sm-6">

                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-add-line ri-1x me-2"></i>Tambah
                                        Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
